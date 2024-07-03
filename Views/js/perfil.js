let intro;
let header;
let logo;
let logoParts;
let body;
let profileIcon;
let profileDropdown;

window.addEventListener('DOMContentLoaded', () => {
    let intro = document.querySelector('.intro');
    let header = document.querySelector('header');
    let logo = document.querySelector('.logo');
    let logoParts = document.querySelectorAll('.logo-parts');
    let body = document.body;

    if (intro && header && body && logo && logoParts) {
        header.style.opacity = '0'; 
        header.style.transition = 'opacity 0.5s ease-in-out'; 
        body.classList.add('hide-header'); 

        setTimeout(() => {
            logoParts.forEach((span, index) => {
                setTimeout(() => {
                    span.classList.add('active');
                }, (index + 1) * 100);
            });

            setTimeout(() => {
                logoParts.forEach((span, index) => {
                    setTimeout(() => {
                        span.classList.remove('active');
                        span.classList.add('fade');
                    }, (index + 1) * 50);
                });
            }, 3000);

            setTimeout(() => {
                intro.style.opacity = '0';
            }, 4000);

            setTimeout(() => {
                intro.style.display = 'none'; 
                header.style.opacity = '1'; 
                body.classList.remove('hide-header'); 
            }, 2600);
        });

        let profileIcon = document.querySelector('.profile-icon');
        let profileDropdown = document.querySelector('.profile-dropdown');

        if (profileIcon && profileDropdown) {
            profileIcon.addEventListener('click', function() {
                profileIcon.classList.toggle('active'); 
            });
            document.addEventListener('click', function(event) {
                if (!profileIcon.contains(event.target) && !profileDropdown.contains(event.target)) {
                    profileIcon.classList.remove('active'); 
                }
            });
        }
    }
});
