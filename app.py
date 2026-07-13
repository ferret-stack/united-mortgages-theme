# app.py - United Mortgages AIP Form Backend with Document Uploads

from flask import Flask, request, jsonify
from flask_cors import CORS
from dotenv import load_dotenv
import os
import requests
import json
import logging
import traceback
from logging.handlers import RotatingFileHandler
from datetime import datetime
from werkzeug.utils import secure_filename
import re

# Load environment variables
load_dotenv()

# Create Flask app
app = Flask(__name__)
CORS(app)  # Enable CORS for all routes

# Configuration
HUBSPOT_API_TOKEN = os.getenv('HUBSPOT_API_TOKEN')
HUBSPOT_API_URL = 'https://api.hubapi.com/crm/v3/objects/contacts'
HUBSPOT_FILES_URL = 'https://api.hubapi.com/filemanager/api/v3/files/upload'
HUBSPOT_NOTES_URL = 'https://api.hubapi.com/crm/v3/objects/notes'

# File upload configuration
UPLOAD_FOLDER = os.path.join(os.path.dirname(__file__), 'uploads')
ALLOWED_EXTENSIONS = {'pdf', 'jpg', 'jpeg', 'png'}
MAX_FILE_SIZE = 10 * 1024 * 1024  # 10MB

# Create upload folder if it doesn't exist
os.makedirs(UPLOAD_FOLDER, exist_ok=True)

# ============================================================================
# HUBSPOT ERROR LOGGER
# ============================================================================

LOG_PATH = os.environ.get(
    'LOG_PATH',
    os.path.join(os.path.dirname(__file__), 'logs', 'hubspot_errors.log')
)
os.makedirs(os.path.dirname(LOG_PATH), exist_ok=True)

hs_logger = logging.getLogger('hubspot')
hs_logger.setLevel(logging.ERROR)
_handler = RotatingFileHandler(LOG_PATH, maxBytes=1_000_000, backupCount=3)
_handler.setFormatter(logging.Formatter('%(asctime)s %(levelname)s %(message)s'))
hs_logger.addHandler(_handler)

# ============================================================================

# Verify API token
if not HUBSPOT_API_TOKEN:
    print("⚠️  WARNING: HUBSPOT_API_TOKEN not found in environment variables!")

# ============================================================================
# HELPER FUNCTIONS
# ============================================================================

def allowed_file(filename):
    """Check if file extension is allowed."""
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS


def normalise_yes_no(value):
    """Convert lowercase yes/no to capitalised Yes/No for HubSpot."""
    if value is None:
        return None
    if str(value).lower() == 'yes' or str(value).lower() == 'true':
        return 'Yes'
    if str(value).lower() == 'no' or str(value).lower() == 'false':
        return 'No'
    return value


# Employment type mapping
EMPLOYMENT_TYPE_MAP = {
    'employed-ft': 'Employed – Permanent Full-Time',
    'employed-pt': 'Employed – Permanent Part-Time',
    'employed-ftc': 'Employed – Fixed-Term Contract',
    'sole-trader': 'Self-Employed – Sole Trader',
    'partnership': 'Self-Employed – Partnership',
    'limited-director': 'Self-Employed – Limited Company Director',
    'contract': 'Freelancer / Contractor',
    'retired': 'Retired',
    'high-net-worth': 'High Net-Worth Individual (HNWI)'
}


def generate_unique_filename(original_filename, applicant_email, document_type):
    """Generate unique filename for uploaded documents."""
    extension = original_filename.rsplit('.', 1)[1].lower()
    clean_email = applicant_email.replace('@', '_').replace('.', '_')
    timestamp = datetime.now().strftime('%Y%m%d_%H%M%S')
    filename = f"{clean_email}_{document_type}_{timestamp}.{extension}"
    return secure_filename(filename)


def save_uploaded_file(file, applicant_email, document_type):
    """Save uploaded file to disk and return filepath."""
    if not file or file.filename == '':
        return None
    
    if not allowed_file(file.filename):
        print(f"  ❌ File type not allowed: {file.filename}")
        return None
    
    filename = generate_unique_filename(file.filename, applicant_email, document_type)
    filepath = os.path.join(UPLOAD_FOLDER, filename)
    
    try:
        file.save(filepath)
        print(f"  ✅ Saved: {filename}")
        return filepath
    except Exception as e:
        print(f"  ❌ Error saving file: {str(e)}")
        return None


def upload_file_to_hubspot(filepath, filename):
    """Upload file to HubSpot and return dict with url and file_id."""
    headers = {
        'Authorization': f'Bearer {HUBSPOT_API_TOKEN}'
    }
    
    try:
        with open(filepath, 'rb') as f:
            files = {
                'file': (filename, f, 'application/octet-stream'),
                'options': (None, json.dumps({
                    'access': 'PUBLIC_NOT_INDEXABLE',
                    'overwrite': False
                }), 'application/json'),
                'folderPath': (None, '/aip-documents')
            }
            
            response = requests.post(HUBSPOT_FILES_URL, headers=headers, files=files, timeout=60)
            
            if response.status_code not in (200, 201):
                print(f"  ❌ HubSpot upload error: {response.status_code}")
                print(f"  ❌ Response: {response.text}")
                hs_logger.error(
                    f'[file-upload] Failed to upload file | '
                    f'filename={filename} | '
                    f'status={response.status_code} | '
                    f'body={response.text}'
                )
            
            response.raise_for_status()
            
            result = response.json()
            file_data = result['objects'][0]
            file_url = file_data['default_hosting_url']
            file_id = file_data['id']
            
            print(f"  ✅ Uploaded to HubSpot (ID: {file_id})")
            return {'url': file_url, 'file_id': file_id}
            
    except Exception as e:
        print(f"  ❌ Error uploading to HubSpot: {str(e)}")
        hs_logger.error(f'[file-upload] Exception uploading file | filename={filename} | error={str(e)}')
        return None


def process_applicant_documents(files_dict, applicant_email, applicant_number):
    """Process all documents for an applicant. Returns dict with urls and file_ids."""
    document_urls = {}
    file_ids = []
    prefix = f'applicant{applicant_number}_'
    
    for key, file in files_dict.items():
        if key.startswith(prefix):
            document_type = key.replace(prefix, '')
            
            print(f"\n📄 {document_type}")
            
            # Save file locally
            filepath = save_uploaded_file(file, applicant_email, document_type)
            
            if filepath:
                # Upload to HubSpot
                result = upload_file_to_hubspot(filepath, file.filename)
                
                if result:
                    document_urls[document_type] = result['url']
                    file_ids.append({
                        'id': result['file_id'],
                        'type': document_type
                    })
                    
                    # Delete local file after successful upload
                    try:
                        os.remove(filepath)
                    except:
                        pass
    
    return {'urls': document_urls, 'file_ids': file_ids}


def create_document_note(contact_id, file_ids, applicant_number):
    """Create a Note on the contact timeline with uploaded documents attached."""
    if not file_ids:
        return None
    
    print(f"\n📝 Creating document note for contact {contact_id}")
    
    headers = {
        'Authorization': f'Bearer {HUBSPOT_API_TOKEN}',
        'Content-Type': 'application/json'
    }
    
    # Build note body with document list
    doc_labels = {
        'proof_of_identity': 'Proof of Identity',
        'proof_of_address': 'Proof of Address',
        'bank_statement_1': 'Bank Statement 1',
        'bank_statement_2': 'Bank Statement 2',
        'bank_statement_3': 'Bank Statement 3',
        'proof_of_deposit': 'Proof of Deposit',
        'payslip_1': 'Payslip 1',
        'payslip_2': 'Payslip 2',
        'payslip_3': 'Payslip 3',
        'sa302_current_year': 'SA302 (Current Year)',
        'sa302_previous_year': 'SA302 (Previous Year)'
    }
    
    doc_list = '\n'.join(
        f"• {doc_labels.get(f['type'], f['type'])}"
        for f in file_ids
    )
    
    note_body = (
        f"<strong>AIP Documents — Applicant {applicant_number}</strong>\n\n"
        f"{doc_list}\n\n"
        f"{len(file_ids)} document(s) uploaded via AIP form on {datetime.now().strftime('%d/%m/%Y at %H:%M')}"
    )
    
    # Build the hs_attachment_ids value (semicolon-separated file IDs)
    attachment_ids = ';'.join(str(f['id']) for f in file_ids)
    
    payload = {
        'properties': {
            'hs_note_body': note_body,
            'hs_attachment_ids': attachment_ids,
            'hs_timestamp': datetime.utcnow().strftime('%Y-%m-%dT%H:%M:%S.000Z')
        },
        'associations': [
            {
                'to': {'id': contact_id},
                'types': [
                    {
                        'associationCategory': 'HUBSPOT_DEFINED',
                        'associationTypeId': 202
                    }
                ]
            }
        ]
    }
    
    try:
        response = requests.post(HUBSPOT_NOTES_URL, headers=headers, json=payload, timeout=30)
        
        if response.status_code not in (200, 201):
            print(f"  ❌ Note creation error: {response.status_code}")
            print(f"  ❌ Response: {response.text}")
            hs_logger.error(
                f'[create-note] Failed to create document note | '
                f'contact_id={contact_id} | '
                f'status={response.status_code} | '
                f'body={response.text}'
            )
        
        response.raise_for_status()
        
        result = response.json()
        print(f"  ✅ Note created with {len(file_ids)} attachment(s)")
        return result
        
    except Exception as e:
        print(f"  ❌ Error creating note: {str(e)}")
        hs_logger.error(f'[create-note] Exception creating note | contact_id={contact_id} | error={str(e)}')
        return None


def map_form_to_hubspot(applicant_data, applicant_number=1, document_urls=None):
    """Map form fields to HubSpot properties."""
    print(f"\n🔄 Mapping Applicant {applicant_number} Data")
    
    properties = {}
    
    # Basic contact info
    if 'email' in applicant_data:
        properties['email'] = applicant_data['email']
    if 'phone' in applicant_data:
        properties['phone'] = applicant_data['phone']
    if 'first_name' in applicant_data:
        properties['firstname'] = applicant_data['first_name']
    if 'last_name' in applicant_data:
        properties['lastname'] = applicant_data['last_name']
    
    # Custom properties - direct mapping
    custom_fields = [
        'date_of_birth', 'marital_status', 'nationality', 'national__insurance__number',
        'current_address_street', 'current_address_town', 'current_address_county',
        'address_postcode', 'electoral_register', 'months_at_address',
        'previous_address_street', 'previous_address_town', 'previous_address_county',
        'previous_address_postcode', 'months_at_previous_address',
        'number_of_dependents', 'ages_of_dependents',
        'employment_type', 'occupation_job_title',
        'employer_name', 'employer_address_street', 'employer_address_city',
        'employer_county', 'employer_postcode', 'total_annual_salary',
        'annual_bonus', 'annual_overtime', 'annual_commission', 'other_annual_income',
        'contract_day_rate', 'contract_days_per_month', 'contract_end_date',
        'business_name',
        'latest_fy_net_profit', 'latest_fy_end', 'latest_fy_salary', 'latest_fy_dividends',
        'previous_fy_net_profit', 'previous_fy_end', 'previous_fy_salary', 'previous_fy_dividends',
        'state_pension_annual', 'private_pension_annual', 'other_retirement_income',
        'total_assets_liabilities', 'hnw_annual_income', 'hnw_income_source',
        'has_outstanding_loans', 'has_credit_cards',
        'deposit_amount', 'deposit_source', 'credit_history_issues', 'credit_history_info'
    ]
    
    for field in custom_fields:
        if field in applicant_data and applicant_data[field] is not None:
            properties[field] = applicant_data[field]
    
    # Map employment type
    if 'employment_type' in properties:
        slug = properties['employment_type']
        properties['employment_type'] = EMPLOYMENT_TYPE_MAP.get(slug, slug)
    
    # Handle loans
    if 'loans' in applicant_data and applicant_data['loans']:
        try:
            loans = json.loads(applicant_data['loans']) if isinstance(applicant_data['loans'], str) else applicant_data['loans']
            properties['loans_data'] = json.dumps(loans)
            
            if len(loans) > 0:
                first_loan = loans[0]
                if 'provider' in first_loan:
                    properties['loan_provider'] = first_loan['provider']
                if 'monthly_payment' in first_loan:
                    properties['loan_monthly_payment'] = first_loan['monthly_payment']
                if 'will_be_settled' in first_loan:
                    properties['loan_balance_settled'] = first_loan['will_be_settled']
        except:
            pass
    
    # Handle credit cards
    if 'credit_cards' in applicant_data and applicant_data['credit_cards']:
        try:
            cards = json.loads(applicant_data['credit_cards']) if isinstance(applicant_data['credit_cards'], str) else applicant_data['credit_cards']
            properties['credit_cards_data'] = json.dumps(cards)
            
            if len(cards) > 0:
                first_card = cards[0]
                if 'provider' in first_card:
                    properties['credit_card_provider'] = first_card['provider']
                if 'balance' in first_card:
                    properties['credit_card_balance'] = first_card['current_balance']
                if 'monthly_payment' in first_card:
                    properties['credit_card_monthly_payment'] = first_card['monthly_payment']
                if 'will_be_settled' in first_card:
                    properties['credit_balance_settled'] = first_card['will_be_settled']
        except:
            pass
    
    # Add document URLs to properties
    if document_urls:
        print(f"📎 Adding {len(document_urls)} document URLs")
        
        document_field_mapping = {
            'proof_of_identity': 'document_proof_of_identity',
            'proof_of_address': 'document_proof_of_address',
            'bank_statement_1': 'document_bank_statement_1',
            'bank_statement_2': 'document_bank_statement_2',
            'bank_statement_3': 'document_bank_statement_3',
            'proof_of_deposit': 'document_proof_of_deposit',
            'payslip_1': 'document_payslip_1',
            'payslip_2': 'document_payslip_2',
            'payslip_3': 'document_payslip_3',
            'sa302_current_year': 'document_sa302_current_year',
            'sa302_previous_year': 'document_sa302_previous_year'
        }
        
        for doc_type, url in document_urls.items():
            hubspot_field = document_field_mapping.get(doc_type)
            if hubspot_field:
                properties[hubspot_field] = url
    
    # Normalise Yes/No fields
    yes_no_fields = ['electoral_register', 'has_outstanding_loans', 'has_credit_cards', 'credit_history_issues', 'loan_balance_settled', 'credit_balance_settled']
    for field in yes_no_fields:
        if field in properties:
            properties[field] = normalise_yes_no(properties[field])

    print(f"✅ Mapped {len(properties)} properties")
    return properties


def create_hubspot_contact(properties):
    """Create or update contact in HubSpot."""
    email = properties.get('email', 'unknown')
    print(f"\n📤 Creating HubSpot Contact: {email}")
    
    headers = {
        'Authorization': f'Bearer {HUBSPOT_API_TOKEN}',
        'Content-Type': 'application/json'
    }
    
    payload = {'properties': properties}
    
    try:
        response = requests.post(HUBSPOT_API_URL, headers=headers, json=payload, timeout=30)
        
        if response.status_code not in (200, 201):
            print(f"  ❌ HubSpot Contact Error: {response.status_code}")
            print(f"  ❌ Response: {response.text}")
            print(f"  ❌ Properties sent: {list(properties.keys())}")
        
        response.raise_for_status()
        
        result = response.json()
        contact_id = result.get('id', 'unknown')
        print(f"  ✅ Contact created! ID: {contact_id}")
        return result
        
    except requests.exceptions.HTTPError as e:
        if e.response.status_code == 409:
            # Contact exists - update instead
            print(f"  ℹ️  Contact exists, updating...")
            url = f"{HUBSPOT_API_URL}/{email}?idProperty=email"
            response = requests.patch(url, headers=headers, json=payload, timeout=30)
            
            if response.status_code not in (200, 201):
                print(f"  ❌ Update Error: {response.text}")
                hs_logger.error(
                    f'[create-contact] Contact update (PATCH) failed | '
                    f'email={email} | '
                    f'status={response.status_code} | '
                    f'body={response.text} | '
                    f'properties={list(properties.keys())}'
                )
            
            response.raise_for_status()
            result = response.json()
            print(f"  ✅ Contact updated!")
            return result
        else:
            # Non-409 HTTP error — log the full HubSpot response before re-raising
            hs_logger.error(
                f'[create-contact] Contact creation (POST) failed | '
                f'email={email} | '
                f'status={e.response.status_code} | '
                f'body={e.response.text} | '
                f'properties={list(properties.keys())}'
            )
            raise


def associate_contacts(email1, email2):
    """Associate two contacts."""
    print(f"\n🔗 Associating {email1} ↔ {email2}")
    
    headers = {
        'Authorization': f'Bearer {HUBSPOT_API_TOKEN}',
        'Content-Type': 'application/json'
    }
    
    try:
        url1 = f"{HUBSPOT_API_URL}/{email1}?idProperty=email"
        payload1 = {'properties': {'associated_applicant_email': email2}}
        requests.patch(url1, headers=headers, json=payload1, timeout=30)
        
        url2 = f"{HUBSPOT_API_URL}/{email2}?idProperty=email"
        payload2 = {'properties': {'associated_applicant_email': email1}}
        requests.patch(url2, headers=headers, json=payload2, timeout=30)
        
        print("  ✅ Contacts associated")
        return True
    except Exception as e:
        print(f"  ❌ Association error: {str(e)}")
        return False


# ============================================================================
# API ROUTES
# ============================================================================

@app.route('/api/health', methods=['GET'])
def health_check():
    """Health check endpoint."""
    return jsonify({
        'status': 'healthy',
        'message': 'Flask API is running',
        'hubspot_token_loaded': bool(HUBSPOT_API_TOKEN)
    }), 200


@app.route('/api/submit-aip', methods=['POST', 'OPTIONS'])
def submit_aip():
    """Main AIP submission endpoint with document uploads."""
    
    if request.method == 'OPTIONS':
        return '', 204
    
    print("\n" + "="*60)
    print("📥 NEW AIP SUBMISSION")
    print("="*60)
    
    try:
        if not HUBSPOT_API_TOKEN:
            return jsonify({'success': False, 'error': 'HubSpot API not configured'}), 500
        
        # Get JSON data
        if 'data' not in request.form:
            return jsonify({'success': False, 'error': 'No form data received'}), 400
        
        form_data = json.loads(request.form['data'])
        
        applicant_type = form_data.get('applicant_type')
        applicant_situation = form_data.get('applicant_situation')
        has_files = len(request.files) > 0
        
        print(f"📋 Type: {applicant_type}")
        print(f"📋 Situation: {applicant_situation}")
        print(f"📎 Files: {len(request.files)}" if has_files else "📎 No documents")
        
        contacts_created = []
        
        # ================================================================
        # PROCESS APPLICANT 1
        # ================================================================
        
        print("\n👤 Processing Applicant 1")
        applicant1_data = form_data['applicant1']
        applicant1_email = applicant1_data.get('email')
        
        # Process documents
        applicant1_doc_result = process_applicant_documents(request.files, applicant1_email, 1)
        applicant1_urls = applicant1_doc_result['urls']
        applicant1_file_ids = applicant1_doc_result['file_ids']
        
        # Map to HubSpot
        applicant1_properties = map_form_to_hubspot(applicant1_data, 1, applicant1_urls)
        applicant1_properties['applicant_type'] = applicant_type
        applicant1_properties['applicant_situation'] = applicant_situation
        
        # Map T&C / privacy acceptance
        privacy_accepted = bool(form_data.get('privacy_accepted', False))
        applicant1_properties['tc_accept'] = privacy_accepted
        
        # Add hasAdditionalSelfEmployedIncome if present
        if 'applicant1_hasAdditionalSelfEmployedIncome' in request.form:
            value = request.form['applicant1_hasAdditionalSelfEmployedIncome']
            applicant1_properties['has_additional_self_employed_income'] = normalise_yes_no(value)
        
        # Create contact
        applicant1_result = create_hubspot_contact(applicant1_properties)
        applicant1_id = applicant1_result.get('id')
        contacts_created.append({
            'applicant': 1,
            'id': applicant1_id,
            'email': applicant1_email
        })
        
        # Attach documents as note on contact timeline
        if applicant1_file_ids:
            create_document_note(applicant1_id, applicant1_file_ids, 1)
        
        # ================================================================
        # PROCESS APPLICANT 2 (if joint)
        # ================================================================
        
        if applicant_type == 'Joint applicant' and 'applicant2' in form_data:
            print("\n👥 Processing Applicant 2")
            applicant2_data = form_data['applicant2']
            applicant2_email = applicant2_data.get('email')
            
            # Process documents
            applicant2_doc_result = process_applicant_documents(request.files, applicant2_email, 2)
            applicant2_urls = applicant2_doc_result['urls']
            applicant2_file_ids = applicant2_doc_result['file_ids']
            
            # Map to HubSpot
            applicant2_properties = map_form_to_hubspot(applicant2_data, 2, applicant2_urls)
            applicant2_properties['applicant_type'] = applicant_type
            applicant2_properties['applicant_situation'] = applicant_situation
            applicant2_properties['tc_accept'] = privacy_accepted
            
            # Add hasAdditionalSelfEmployedIncome if present
            if 'applicant2_hasAdditionalSelfEmployedIncome' in request.form:
                value = request.form['applicant2_hasAdditionalSelfEmployedIncome']
                applicant2_properties['has_additional_self_employed_income'] = normalise_yes_no(value)
            
            # Create contact
            applicant2_result = create_hubspot_contact(applicant2_properties)
            applicant2_id = applicant2_result.get('id')
            contacts_created.append({
                'applicant': 2,
                'id': applicant2_id,
                'email': applicant2_email
            })
            
            # Attach documents as note on contact timeline
            if applicant2_file_ids:
                create_document_note(applicant2_id, applicant2_file_ids, 2)
            
            # Associate contacts
            associate_contacts(applicant1_email, applicant2_email)
        
        # ================================================================
        # SUCCESS
        # ================================================================
        
        print("\n" + "="*60)
        print("✅ SUBMISSION SUCCESSFUL!")
        print(f"📊 Contacts Created: {len(contacts_created)}")
        print("="*60 + "\n")
        
        return jsonify({
            'success': True,
            'message': 'Application submitted successfully',
            'contacts_created': contacts_created
        }), 200
        
    except Exception as e:
        print(f"\n❌ ERROR: {str(e)}")
        traceback.print_exc()
        hs_logger.error(
            f'[submit-aip] Unhandled exception during submission | '
            f'error={str(e)} | '
            f'trace={traceback.format_exc()}'
        )
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500


@app.route('/api/exit-intent-submit', methods=['POST'])
def exit_intent_submit():
    data = request.get_json(silent=True)

    if not data:
        return jsonify({'error': 'Invalid JSON'}), 400

    email   = (data.get('email') or '').strip()
    consent = data.get('exit_intent_consent', False)
    step    = data.get('form_step_reached', 0)

    if not email:
        return jsonify({'error': 'Email is required'}), 400

    if not re.match(r'^[^\s@]+@[^\s@]+\.[^\s@]+$', email):
        return jsonify({'error': 'Invalid email'}), 400

    if not consent:
        return jsonify({'error': 'Consent is required'}), 400

    try:
        hs_payload = {
            "properties": {
                "email": email,
                "exit_intent_consent": True,
                "aip_form_step_reached": step,
                "hs_lead_status": "IN_PROGRESS",
            }
        }

        headers = {
            'Authorization': f'Bearer {HUBSPOT_API_TOKEN}',
            'Content-Type': 'application/json'
        }

        response = requests.post(
            HUBSPOT_API_URL,
            json=hs_payload,
            headers=headers,
            timeout=10
        )

        if response.status_code == 409:
            contact_id = response.json().get('message', '').split('existing ID: ')[-1]
            if contact_id:
                requests.patch(
                    f'{HUBSPOT_API_URL}/{contact_id}',
                    json={"properties": {
                        "exit_intent_consent": True,
                        "aip_form_step_reached": step
                    }},
                    headers=headers,
                    timeout=10
                )
        elif response.status_code not in (200, 201):
            hs_logger.error(
                f'[exit-intent] HubSpot error | '
                f'email={email} | '
                f'status={response.status_code} | '
                f'body={response.text}'
            )
            return jsonify({'error': 'CRM update failed'}), 502

    except requests.exceptions.RequestException as e:
        hs_logger.error(f'[exit-intent] Request failed | email={email} | error={str(e)}')
        return jsonify({'error': 'CRM unavailable'}), 503

    return jsonify({'status': 'ok'}), 200


# ============================================================================
# RUN APPLICATION
# ============================================================================

if __name__ == '__main__':
    print("\n" + "="*60)
    print("🚀 UNITED MORTGAGES AIP API")
    print("="*60)
    print(f"🔑 HubSpot Token: {'✅ Loaded' if HUBSPOT_API_TOKEN else '❌ Missing'}")
    print(f"📂 Upload Folder: {UPLOAD_FOLDER}")
    print(f"🌐 Local: http://localhost:5000")
    print(f"💚 Health: http://localhost:5000/api/health")
    print("="*60 + "\n")
    
    app.run(debug=True, host='0.0.0.0', port=5000)