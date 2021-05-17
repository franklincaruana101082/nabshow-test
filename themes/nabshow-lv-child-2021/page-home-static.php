<?php
/**
 * Template Name: Home Page (Static)
 * Description: Static Home page template to get up quickly
 *
 */


get_header();
?>

<main id="main">
  <div class="hero" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/las-vegas-hero.jpg);">
    <div class="container">
      <div class="hero__inner" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/las-vegas-hero.jpg);">
        <div class="hero__content">
          <h1 class="hero__label">October 9 - 13, 2021 | Las Vegas</h1>
          <img class="hero__logo" src="/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Show_Logo_White.png" alt="NAB Show where content comes to life" />
          <ul class="hero__ctas">
            <li class="hero__cta">
              <a href="/show" class="button _solid">Register To Attend</a>
            </li>
            <li class="hero__cta">
              <a href="/#tba-hotel" class="button _arrow _large">Book a Hotel</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="container section">
    <div class="jump-links">
      <h2 class="jump-links__label">Quick Links:</h2>
      <ul class="jump-links__menu">
        <li class="jump-links__item"><a href="<?php echo site_url('/attend/'); ?>" class="button _arrow _full">Attend</a></li>
        <li class="jump-links__item"><a href="<?php echo site_url('/resources-for/press/'); ?>" class="button _arrow _full">Press</a></li>
        <li class="jump-links__item"><a href="<?php echo site_url('/exhibit/'); ?>" class="button _arrow _full">Exhibit</a></li>
        <li class="jump-links__item"><a href="<?php echo site_url('/sponsor/'); ?>" class="button _arrow _full">Sponsor</a></li>
      </ul>
    </div>
  </div>

  <div class="container section">
    <div class="cols">
      <div class="col intro-body-text">
        <h2 class="h-lg">IT’S SO ON</h2>
        <p><strong>This October, the wait is over -- NAB Show returns to Las Vegas.</strong> No matter where you fall in the content ecosystem, this is where you’ll reconnect to the tools, technology and people who will empower you on your path. Take the first look at brand-new products and applications. Engage in compelling conversations with current and future partners. And immerse yourself in an experience-rich show floor, where innovative and future-ready solutions are waiting at every turn. If you’re involved with the business of storytelling, then you belong at NAB Show. 
        </p>
        <a href="<?php echo site_url('/attend/'); ?>" class="button _arrow _alt _full">Learn More About The Show</a>
      </div>
      <div class="col">
        <figure class="figure">
          <div class="figure__media">
            <div style="position: relative; display: block; max-width: 100%;"><div style="padding-top: 56.25%;"><iframe src="https://players.brightcove.net/1496514776001/S1IGg23j_default/index.html?videoId=6015758748001" allowfullscreen="" allow="encrypted-media" style="position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; width: 100%; height: 100%;"></iframe></div></div>
          </div>
          <figcaption class="figure__caption">
            <p>PHOTO CREDIT Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, odio voluptatem.</p>        
          </figcaption>
        </figure>
      </div>
    </div>
  </div>

  <div class="section _toplarge">
    <div class="banner">
      <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/las-vegas-banner.jpg" class="banner__image" alt="alt-here" />
    </div>
  </div>

  <div class="schedule">
    <div class="schedule__menu">
      <div class="schedule__menu-item"><span class="schedule__menu-item-day-short">TU</span><span class="schedule__menu-item-day">Tuesday</span><span class="schedule__menu-item-num">09</span></div>
      <div class="schedule__menu-item"><span class="schedule__menu-item-day-short">W</span><span class="schedule__menu-item-day">Wednesday</span><span class="schedule__menu-item-num">10</span></div>
      <div class="schedule__menu-item"><span class="schedule__menu-item-day-short">TH</span><span class="schedule__menu-item-day">Thursday</span><span class="schedule__menu-item-num">11</span></div>
      <div class="schedule__menu-item"><span class="schedule__menu-item-day-short">F</span><span class="schedule__menu-item-day">Friday</span><span class="schedule__menu-item-num">12</span></div>
      <div class="schedule__menu-item"><span class="schedule__menu-item-day-short">SA</span><span class="schedule__menu-item-day">Saturday</span><span class="schedule__menu-item-num">13</span></div>
    </div>
    <div class="schedule__days">
      <div class="schedule__day">
        <div class="schedule__day-wrapper" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/schedule-background.jpg);">
          <div class="container">
            <div class="schedule__day-content">
              <h3 class="schedule__day-time">5:00PM - 6:30PM</h3>
              <h4 class="schedule__day-title">09 GET THE BIG PICTURE PLAN YOUR PERFECT SHOW</h4>
              <div class="schedule__day-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum, nunc ligula sagittis dolor, at fringilla sem arcu quis neque. Sed sed aliquet arcu, sed accumsan libero. Aenean scelerisque magna vitae vulputate. </p>
              </div>
              <div class="schedule__day-cta">
                <a href="#" class="button _solid">View More</a>
              </div>
            </div>
          </div>          
        </div>
        <div class="schedule__sessions">
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
        </div>
      </div>
      <div class="schedule__day">
        <div class="schedule__day-wrapper" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/schedule-background.jpg);">
          <div class="container">
            <div class="schedule__day-content">
              <h3 class="schedule__day-time">5:00PM - 6:30PM</h3>
              <h4 class="schedule__day-title">10 GET THE BIG PICTURE PLAN YOUR PERFECT SHOW</h4>
              <div class="schedule__day-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum, nunc ligula sagittis dolor, at fringilla sem arcu quis neque. Sed sed aliquet arcu, sed accumsan libero. Aenean scelerisque magna vitae vulputate. </p>
              </div>
              <div class="schedule__day-cta">
                <a href="#" class="button _solid">View More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="schedule__sessions">
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
        </div>
      </div>
      <div class="schedule__day">
        <div class="schedule__day-wrapper" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/schedule-background.jpg);">
          <div class="container">
            <div class="schedule__day-content">
              <h3 class="schedule__day-time">5:00PM - 6:30PM</h3>
              <h4 class="schedule__day-title">11 GET THE BIG PICTURE PLAN YOUR PERFECT SHOW</h4>
              <div class="schedule__day-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum, nunc ligula sagittis dolor, at fringilla sem arcu quis neque. Sed sed aliquet arcu, sed accumsan libero. Aenean scelerisque magna vitae vulputate. </p>
              </div>
              <div class="schedule__day-cta">
                <a href="#" class="button _solid">View More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="schedule__sessions">
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
        </div>
      </div>
      <div class="schedule__day">
        <div class="schedule__day-wrapper" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/schedule-background.jpg);">
          <div class="container">
            <div class="schedule__day-content">
              <h3 class="schedule__day-time">5:00PM - 6:30PM</h3>
              <h4 class="schedule__day-title">12 GET THE BIG PICTURE PLAN YOUR PERFECT SHOW</h4>
              <div class="schedule__day-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum, nunc ligula sagittis dolor, at fringilla sem arcu quis neque. Sed sed aliquet arcu, sed accumsan libero. Aenean scelerisque magna vitae vulputate. </p>
              </div>
              <div class="schedule__day-cta">
                <a href="#" class="button _solid">View More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="schedule__sessions">
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
        </div>
      </div>
      <div class="schedule__day">
        <div class="schedule__day-wrapper" style="background-image: url(/wp-content/themes/nabshow-lv-child-2021/assets/images/schedule-background.jpg);">
          <div class="container">
            <div class="schedule__day-content">
              <h3 class="schedule__day-time">5:00PM - 6:30PM</h3>
              <h4 class="schedule__day-title">13 GET THE BIG PICTURE PLAN YOUR PERFECT SHOW</h4>
              <div class="schedule__day-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum, nunc ligula sagittis dolor, at fringilla sem arcu quis neque. Sed sed aliquet arcu, sed accumsan libero. Aenean scelerisque magna vitae vulputate. </p>
              </div>
              <div class="schedule__day-cta">
                <a href="#" class="button _solid">View More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="schedule__sessions">
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <!-- example of a session without a link uses a div instead of an anchor -->
            <div class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-nab-smte.png" alt="logo alt text" />
                <!-- there is no content without a link -->
            </div>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-radio-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-aes-show.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
          <div class="schedule__session">
            <a href="#" class="schedule__session-item">
              <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-business-of-media.png" alt="logo alt text" />
            <div class="schedule__session-item-content">
              <h5 class="schedule__session-item-title">Title Here</h5>
              <div class="schedule__session-item-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dignissimos laudantium magnam mollitia dolor cum officiis eum doloremque alias voluptatum?</p>
              </div>
              <h6 class="schedule__session-item-time">5:30PM - 6:30PM</h6>
              <div class="schedule__session-item-cta">
                <span class="button _solid _compact">Register</span>
              </div>
            </div>
          </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section _mnop decorative _lightlines-left-side">
    <div class="container">
      <div class="amplify">
        <div class="amplify__container">
          <div class="amplify__logo">
            <img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Amplify_logo.png" alt="Amplify" />
          </div>
          <div class="amplify__body">
            <h2 class="h-xl">ENTER YOUR EMAIL TO GET NAB CONTENT, NETWORKING AND DISCOVERY ALL YEAR ROUND.</h2>
          </div>
          <div class="amplify__form">
          	<form class="email-signup" id="mktoForm_1033"></form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section container">
    <div class="section-heading">
      <h2 class="h-xl">STORIES FROM AMPLIFY</h2>
    </div>
    <div class="stories">
      <a class="story" href="#">
        <div class="story__media">
          <figure class="figure">
            <div class="figure__media">
              <img src="https://www.fillmurray.com/482/271" alt="alt-here" />
            </div>              
          </figure>
        </div>
        <div class="story__body">
          <h4 class="story__title">The Unrailed event for content profressionals in media.</h4>
          <p>
            Ut egestas, enim eu porta rutrum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum.
          </p>
        </div>
      </a>
      <a class="story" href="#">
        <div class="story__media">
          <figure class="figure">
            <div class="figure__media">
              <img src="https://www.fillmurray.com/482/271" alt="alt-here" />
            </div>              
          </figure>
        </div>
        <div class="story__body">
          <h4 class="story__title">The Unrailed event for content profressionals in media.</h4>
          <p>
            Ut egestas, enim eu porta rutrum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum.
          </p>
        </div>
      </a>
      <a class="story" href="#">
        <div class="story__media">
          <figure class="figure">
            <div class="figure__media">
              <img src="https://www.fillmurray.com/482/271" alt="alt-here" />
            </div>              
          </figure>
        </div>
        <div class="story__body">
          <h4 class="story__title">The Unrailed event for content profressionals in media.</h4>
          <p>
            Ut egestas, enim eu porta rutrum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum.
          </p>
        </div>
      </a>
      <a class="story" href="#">
        <div class="story__media">
          <figure class="figure">
            <div class="figure__media">
              <img src="https://www.fillmurray.com/482/271" alt="alt-here" />
            </div>              
          </figure>
        </div>
        <div class="story__body">
          <h4 class="story__title">The Unrailed event for content profressionals in media.</h4>
          <p>
            Ut egestas, enim eu porta rutrum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas, enim eu porta rutrum.
          </p>
        </div>
      </a>
    </div>
  </div>

  <div class="decorative _lightlines-footer-corner"></div>
</main><!-- #main -->


<?php
get_footer();
