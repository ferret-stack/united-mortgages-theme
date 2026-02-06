<footer class="site-footer">
    <div class="container">
      <div class="footer-content">
        <!-- Footer Logo -->
        <div class="footer-logo">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/united-logo.png" alt="United Mortgages" class="footer-logo-img">
        </div>
        
        <!-- Footer Columns -->
        <div class="footer-columns">
          <!-- For Clients Column -->
          <div class="footer-column">
            <h3 class="footer-heading">FOR CLIENTS</h3>
            <ul class="footer-links">
              <li><a href="<?php echo home_url('/aip-overview'); ?>">Start your mortgage journey</a></li>
              <li><a href="/our-mortgages">Our Mortgages</a></li>
              <li><a href="/calculators#borrow">How Much Can I Borrow?</a></li>
              <li><a href="/calculators#repayment">Repayment Calculator</a></li>
              <li><a href="/calculators#overpayment">Overpayment Calculator</a></li>
              <li><a href="/calculators#stamp-duty">Calculate Your Stamp Duty</a></li>
              <li><a href="https://www.propertylikeapro.co.uk/">Buy-to-let Investment</a></li>
            </ul>
          </div>
          
          <!-- For Agents Column -->
          <div class="footer-column">
            <h3 class="footer-heading">FOR AGENTS</h3>
            <ul class="footer-links">
              <li><a href="https://2eys75.share-eu1.hsforms.com/2cunAqDiHS_GA3IqP1eFT3A">Refer a client</a></li>
            </ul>
          </div> 
          
          <!-- Our Company Column -->
          <div class="footer-column">
            <h3 class="footer-heading">OUR COMPANY</h3>
            <ul class="footer-links">
              <li><a href="/our-story">Our story</a></li>
              <li><a href="our-story#tegridy">Integrity and Ethics</a></li>
              <li><a href="/fee-structure">Our fees</a></li>
              <li><a href="/privacy-policy">Privacy Policy</a></li>
            </ul>
          </div>
        </div>
        
        <!-- Newsletter Section -->
        <div class="footer-newsletter">
          <div class="newsletter-content">
            <div class="social-icons">
              <a href="http://instagram.com/unitedmortgageshq" class="social-icon" aria-label="Instagram">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="https://www.linkedin.com/company/unitedmortgages" class="social-icon" aria-label="LinkedIn">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a href="https://wa.me/447451201210" class="social-icon" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-whatsapp"></i>
              </a>
              <!-- <a href="https://www.youtube.com/@unitedmortgages" class="social-icon" aria-label="YouTube">
                <i class="fa-brands fa-youtube"></i>
              </a> 
              <a href="https://www.tiktok.com/@unitedmortgages/" class="social-icon" aria-label="TikTok">
                <i class="fa-brands fa-tiktok"></i>
              </a> -->
              <a href="https://www.facebook.com/profile.php?id=61577124853697" class="social-icon" aria-label="Facebook">
                <i class="fab fa-facebook"></i>
              </a>
            </div>
            <!-- <div class="newsletter-text">
              <p class="newsletter-heading">For United Mortgages&reg;<br>updates delivered straight<br>to your inbox</p>
            </div>
            <div class="newsletter-button">
              <a href="#" class="btn-secondary">Join our community</a> -->
            </div>
          </div>
        </div>
      </div>

      <!-- Contact Section -->
      <div class="footer-contact">
        <h3 class="contact-heading">CONTACT US</h3>
        <div class="contact-items">
          <a href="mailto:hello@united-mortgages.com" class="contact-item">
            <i class="fas fa-envelope"></i> hello@united-mortgages.com
          </a>
          <a href="tel:02034517973" class="contact-item">
            <i class="fas fa-phone"></i> 0203 451 7973
          </a>
          <a href="https://api.whatsapp.com/send?phone=447451201210" class="contact-item">
            <i class="fas fa-comments"></i> Chat now
          </a>
          <a href="<?php echo home_url('/aip-overview'); ?>" class="contact-item">
            <i class="fas fa-rocket"></i> Start your journey
          </a>
        </div>
      </div>
      
      <!-- Copyright Section -->
      <div class="footer-bottom">
        <p>&copy; United Mortgages&reg; <?php echo date('Y'); ?>. All rights reserved.</p>
      </div>
      
      <!-- Legal Text -->
      <div class="footer-legal">
        <p>Your home may be repossessed if you do not keep up repayments on your mortgage. Terms and conditions apply.</p>
        <p>The guidance and/or advice contained within this website is subject to the UK regulatory regime and is therefore targeted at consumers based in the UK. For more please read our guidelines below. Your home may be repossessed if you do not keep up repayments on your mortgage. You voluntarily choose to provide personal details to us via this website. Personal information will be treated as confidential by us and held in accordance with the Data Protection Act 2018. You agree that such personal information may be used to provide you with details of services and products in writing, by email or by telephone.</p>
        <p>United Mortgages&reg; is a trademark and trading name of United Mortgages Limited, registered in England and Wales at 85 Great Portland Street, London, W1W 7LT. Company Number 16154790. United Mortgages&reg; are an introducer to Mainly Mortgages Ltd T/A GooCho Mortgage, Authorised And Regulated By The Financial Conduct Authority Under Number 923399 In Respect Of Mortgages, Insurances And Consumer Credit Mediation Activities Only.</p>
      </div>
    </div>
  </footer>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <?php wp_footer(); ?>
</body>
</html>