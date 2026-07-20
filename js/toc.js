document.addEventListener('DOMContentLoaded', function () {
    var content = document.querySelector('.um-post-content');
    var widget = document.getElementById('toc-widget');
    var nav = widget ? widget.querySelector('.um-toc-nav') : null;

    if (!content || !nav) {
        return;
    }

    var headings = content.querySelectorAll('h2, h3');

    if (headings.length < 2) {
        widget.style.display = 'none';
        return;
    }

    headings.forEach(function (heading, index) {
        if (!heading.id) {
            heading.id = 'toc-' + index;
        }

        var link = document.createElement('a');
        link.href = '#' + heading.id;
        link.textContent = heading.textContent;

        if (heading.tagName === 'H3') {
            link.classList.add('um-toc-nav__h3');
        }

        nav.appendChild(link);
    });

    var links = nav.querySelectorAll('a');

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) {
                return;
            }

            links.forEach(function (link) {
                link.classList.remove('is-active');
            });

            var activeLink = nav.querySelector('a[href="#' + entry.target.id + '"]');

            if (activeLink) {
                activeLink.classList.add('is-active');
            }
        });
    }, { rootMargin: '-20% 0px -70% 0px' });

    headings.forEach(function (heading) {
        observer.observe(heading);
    });
});
