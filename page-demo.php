<?php
/**
 * Demo page with code snippets and useful examples.
 *
 * @package _it_start
 */

get_header();
the_post();
?>
	<style>
			.entry-content pre {
				line-height: 0;
				margin: 0;
			}

			.entry-content pre code {
				line-height: 1.5;
			}

			.entry-content a[target="_blank"] {
				padding-right: 18px;
				background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'%3E%3Cpath d='M400 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zm16 400c0 8.822-7.178 16-16 16H48c-8.822 0-16-7.178-16-16V80c0-8.822 7.178-16 16-16h352c8.822 0 16 7.178 16 16v352zM99.515 374.828c-4.686-4.686-4.686-12.284 0-16.971l195.15-195.15-.707-.707-89.958.342c-6.627 0-12-5.373-12-12v-9.999c0-6.628 5.372-12 12-12L340 128c6.627 0 12 5.372 12 12l-.343 136c0 6.627-5.373 12-12 12h-9.999c-6.627 0-12-5.373-12-12l.342-89.958-.707-.707-195.15 195.15c-4.686 4.686-12.284 4.686-16.971 0l-5.657-5.657z' fill='%23DF0000'/%3E%3C/svg%3E") no-repeat;
				background-position: 100% 50%;
				background-size: 12px;
			}

			.margin-y-100 {
				margin: 100px 0;
			}
	</style>

<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php if ( have_rows( 'builder' ) ) : ?>

	<?php get_template_part( 'template-parts/builder' ); ?>

<?php else : ?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-9">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<section class="entry-content">
					<?php the_content(); ?>

					<div class="anchor" id="code-snippets"></div>
					<h2>Code Snippets:</h2>
					<h4>Component: Modal</h4>
					<p><a href="#" class="btn btn-primary-outline js-modal-open" data-modal="modal-demo-cf7">Open Modal with Contact Form 7</a></p>
					<p><a href="#" class="btn btn-primary-outline js-modal-open" data-modal="modal-demo-gf">Open Modal with Gravity Forms</a></p>
					<div class="modal" id="modal-demo-cf7">
						<div class="modal__overlay"></div>
						<div class="modal__inner">
							<div class="modal__content">
								<div class="modal__close js-modal-close">
									<svg>
										<use xlink:href="#close"></use>
									</svg>
								</div>
								<div class="modal__content-inner">
									<?php echo do_shortcode( '[contact-form-7 id="132" title="Contact form: Demo"]' ) ?>
								</div>
							</div>
						</div>
					</div>

					<div class="modal" id="modal-demo-gf">
						<div class="modal__overlay"></div>
						<div class="modal__inner">
							<div class="modal__content">
								<div class="modal__close js-modal-close">
									<svg>
										<use xlink:href="#close"></use>
									</svg>
								</div>
								<div class="modal__content-inner">
									<?php echo do_shortcode( '[gravityform id="1" title="false" ajax="true"]' ) ?>
								</div>
							</div>
						</div>
					</div>

					<p><a href="#" class="js-toggle" data-item="snippet-modal">Code Snippet
							<svg width="16" height="16">
								<use xlink:href="#angle-down"></use>
							</svg>
						</a></p>
					<div class="js-toggle-content" id="snippet-modal">
						<pre>
							<code>
&lt;div class=&quot;js-modal-open&quot; data-modal=&quot;modal-demo&quot;&gt;Open Modal&lt;/div&gt;
&lt;div class=&quot;modal&quot; id=&quot;modal-demo&quot;&gt;
	&lt;div class=&quot;modal__overlay&quot;&gt;&lt;/div&gt;
	&lt;div class=&quot;modal__inner&quot;&gt;
		&lt;div class=&quot;modal__content&quot;&gt;
			&lt;div class=&quot;modal__close js-modal-close&quot;&gt;
				&lt;svg&gt;&lt;use xlink:href=&quot;#close&quot;&gt;&lt;/use&gt;&lt;/svg&gt;
			&lt;/div&gt;
			&lt;div class=&quot;modal__content-inner&quot;&gt;
				content here
			&lt;/div&gt;
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;
							</code>
						</pre>
					</div>

					<hr>

					<h4>Component: Toggle</h4>
					<p><a href="#" class="btn btn-primary-outline js-toggle" data-item="toggle-demo">Toggle Collapsed Element</a></p>
					<div class="js-toggle-content" id="toggle-demo">
						<p>Collapsed content here</p>
					</div>

					<p><a href="#" class="js-toggle" data-item="snippet-toggle">Code Snippet
							<svg width="16" height="16">
								<use xlink:href="#angle-down"></use>
							</svg>
						</a></p>
					<div class="js-toggle-content" id="snippet-toggle">
						<pre>
							<code>
&lt;a href=&quot;#&quot; class=&quot;js-toggle&quot; data-item=&quot;toggle-demo&quot;&gt;Toggle Collapsed Element&lt;/a&gt;
&lt;div class=&quot;js-toggle-content&quot; id=&quot;toggle-demo&quot;&gt;
    Collapsed content here
&lt;/div&gt;
							</code>
						</pre>
					</div>

					<hr>

					<h4>Component: Accordion</h4>
					<div class="js-accordion">
						<div class="js-accordion-item">
							<div class="h5 js-accordion-title"><span>Accordion Title 1</span>
								<svg width="16" height="16">
									<use xlink:href="#angle-down"></use>
								</svg>
							</div>
							<div class="js-accordion-content" style="background: #f1f1f1; padding: 15px; margin-bottom: 15px;"><strong>Accordion Content 1</strong></div>
						</div>
						<div class="js-accordion-item">
							<div class="h5 js-accordion-title"><span>Accordion Title 2</span>
								<svg width="16" height="16">
									<use xlink:href="#angle-down"></use>
								</svg>
							</div>
							<div class="js-accordion-content" style="background: #ffeb3b; padding: 15px; margin-bottom: 15px;"><strong>Accordion Content 2</strong></div>
						</div>
					</div>

					<p><a href="#" class="js-toggle" data-item="snippet-accordion">Code Snippet
							<svg width="16" height="16">
								<use xlink:href="#angle-down"></use>
							</svg>
						</a></p>
					<div class="js-toggle-content" id="snippet-accordion">
						<pre>
							<code>
&lt;div class=&quot;js-accordion&quot;&gt;
    &lt;div class=&quot;js-accordion-item&quot;&gt;
        &lt;div class=&quot;h5 js-accordion-title&quot;&gt;&lt;span&gt;Accordion Title 1&lt;/span&gt;
            &lt;svg width=&quot;16&quot; height=&quot;16&quot;&gt;&lt;use xlink:href=&quot;#angle-down&quot;&gt;&lt;/use&gt;&lt;/svg&gt;
        &lt;/div&gt;
        &lt;div class=&quot;js-accordion-content&quot;&gt;&lt;p&gt;Accordion Content 1&lt;/p&gt;&lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;js-accordion-item&quot;&gt;
        &lt;div class=&quot;h5 js-accordion-title&quot;&gt;&lt;span&gt;Accordion Title 2&lt;/span&gt;
            &lt;svg width=&quot;16&quot; height=&quot;16&quot;&gt;&lt;use xlink:href=&quot;#angle-down&quot;&gt;&lt;/use&gt;&lt;/svg&gt;
        &lt;/div&gt;
        &lt;div class=&quot;js-accordion-content&quot;&gt;&lt;p&gt;Accordion Content 2&lt;/p&gt;&lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
							</code>
						</pre>
					</div>

					<hr>

					<h4>Component: Tabs</h4>
					<h5>&bull; Horizontal Tabs</h5>
					<div class="js-tabs tabs tabs--horizontal">
						<div class="tabs__titles" style="margin-bottom: 15px;">
							<div class="js-tab-title is-active" data-item="tab-1">Tab Title 1</div>
							<div class="js-tab-title" data-item="tab-2">Tab Title 2</div>
						</div>
						<div class="tabs__contents" style="margin-bottom: 15px;">
							<div class="js-tab-content is-active" id="tab-1" style="background: #f1f1f1; padding: 15px;"><strong>Tab Content 1</strong></div>
							<div class="js-tab-content" id="tab-2" style="background: #ffeb3b; padding: 15px;"><strong>Tab Content 2</strong></div>
						</div>
					</div>

					<br>

					<p><a href="#" class="js-toggle" data-item="snippet-tabs-horizontal">Code Snippet
							<svg width="16" height="16">
								<use xlink:href="#angle-down"></use>
							</svg>
						</a></p>
					<div class="js-toggle-content" id="snippet-tabs-horizontal">
						<pre>
							<code>
&lt;div class=&quot;js-tabs tabs tabs--horizontal&quot;&gt;
    &lt;div class=&quot;tabs__titles&quot;&gt;
        &lt;div class=&quot;js-tab-title is-active&quot; data-item=&quot;tab-1&quot;&gt;Tab Title 1&lt;/div&gt;
        &lt;div class=&quot;js-tab-title&quot; data-item=&quot;tab-2&quot;&gt;Tab Title 2&lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;tabs__contents&quot;&gt;
        &lt;div class=&quot;js-tab-content is-active&quot; id=&quot;tab-1&quot;&gt;&lt;strong&gt;Tab Content 1&lt;/strong&gt;&lt;/div&gt;
        &lt;div class=&quot;js-tab-content&quot; id=&quot;tab-2&quot;&gt;&lt;strong&gt;Tab Content 2&lt;/strong&gt;&lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
							</code>
						</pre>
					</div>

					<h5>&bull; Vertical Tabs</h5>
					<div class="js-tabs tabs tabs--vertical">
						<div class="tabs__titles">
							<div class="js-tab-title is-active" data-item="tab-1">Tab Title 1</div>
							<div class="js-tab-title" data-item="tab-2">Tab Title 2</div>
						</div>
						<div class="tabs__contents">
							<div class="js-tab-content is-active" id="tab-1" style="background: #f1f1f1; padding: 15px;"><strong>Tab Content 1</strong></div>
							<div class="js-tab-content" id="tab-2" style="background: #ffeb3b; padding: 15px;"><strong>Tab Content 2</strong></div>
						</div>
					</div>

					<br>

					<p><a href="#" class="js-toggle" data-item="snippet-tabs-vertical">Code Snippet
							<svg width="16" height="16">
								<use xlink:href="#angle-down"></use>
							</svg>
						</a></p>
					<div class="js-toggle-content" id="snippet-tabs-vertical">
						<pre>
							<code>
&lt;div class=&quot;js-tabs tabs tabs--vertical&quot;&gt;
    &lt;div class=&quot;tabs__titles&quot;&gt;
        &lt;div class=&quot;js-tab-title is-active&quot; data-item=&quot;tab-1&quot;&gt;Tab Title 1&lt;/div&gt;
        &lt;div class=&quot;js-tab-title&quot; data-item=&quot;tab-2&quot;&gt;Tab Title 2&lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;tabs__contents&quot;&gt;
        &lt;div class=&quot;js-tab-content is-active&quot; id=&quot;tab-1&quot;&gt;&lt;strong&gt;Tab Content 1&lt;/strong&gt;&lt;/div&gt;
        &lt;div class=&quot;js-tab-content&quot; id=&quot;tab-2&quot;&gt;&lt;strong&gt;Tab Content 2&lt;/strong&gt;&lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
							</code>
						</pre>
					</div>

					<hr>

					<h4>Slider Swiper.js</h4>
					<p>Check <strong>Swiper Demos</strong> <a href="https://swiperjs.com/demos" target="_blank">here</a>.<br>
						Check <strong>Swiper API</strong> <a href="https://swiperjs.com/swiper-api" target="_blank">here</a>.</p>
					<div class="swiper swiper-images">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div style="width: 100%; height: 350px; background: #2196f3;"></div>
							</div>
							<div class="swiper-slide">
								<div style="width: 100%; height: 350px; background: #ffeb3b;"></div>
							</div>
						</div>
						<div class="swiper-pagination"></div>
						<div class="swiper-button-prev">
							<svg>
								<use xlink:href="#angle-left"></use>
							</svg>
						</div>
						<div class="swiper-button-next">
							<svg>
								<use xlink:href="#angle-right"></use>
							</svg>
						</div>
					</div>

					<br>

					<p><a href="#" class="js-toggle" data-item="snippet-swiper">Code Snippet
							<svg width="16" height="16">
								<use xlink:href="#angle-down"></use>
							</svg>
						</a></p>
					<div class="js-toggle-content" id="snippet-swiper">
						<pre>
							<code>
&lt;div class=&quot;swiper swiper-images&quot;&gt;
    &lt;div class=&quot;swiper-wrapper&quot;&gt;
        &lt;div class=&quot;swiper-slide&quot;&gt;
            &lt;img src=&quot;&quot; alt=&quot;&quot;&gt;
        &lt;/div&gt;
        &lt;div class=&quot;swiper-slide&quot;&gt;
            &lt;img src=&quot;&quot; alt=&quot;&quot;&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;swiper-pagination&quot;&gt;&lt;/div&gt;
    &lt;div class=&quot;swiper-button-prev&quot;&gt;&lt;svg&gt;&lt;use xlink:href=&quot;#angle-left&quot;&gt;&lt;/use&gt;&lt;/svg&gt;&lt;/div&gt;
&#x9;&lt;div class=&quot;swiper-button-next&quot;&gt;&lt;svg&gt;&lt;use xlink:href=&quot;#angle-right&quot;&gt;&lt;/use&gt;&lt;/svg&gt;&lt;/div&gt;
&lt;/div&gt;

&lt;script&gt;
    demoSlider = document.querySelectorAll(&apos;.swiper-demo&apos;);
    if (demoSlider) {
        demoSlider.forEach(slider =&gt; {
            const swiper = new Swiper(slider, {
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: slider.parentNode.querySelector(&apos;.swiper-pagination&apos;),
                    clickable: true,
                },
                navigation: {
                    nextEl: slider.parentNode.querySelector(&apos;.swiper-button-next&apos;),
                    prevEl: slider.parentNode.querySelector(&apos;.swiper-button-prev&apos;),
                },
                on: {
                    // lazy load images
                    slideChange: function () {
                        try {
                            lazyLoadInstance.update();
                        } catch (e) {
                        }
                    }
                }
            });
        });
    }
&lt;/script&gt;
							</code>
						</pre>
					</div>

					<hr>

					<h4>Fancybox</h4>
					<p>
						<!-- Video lightbox-->
						<a data-fancybox="gallery" data-src="https://youtu.be/nqye02H_H6I">
							<img src="https://lipsum.app/id/3/200x150"/>
						</a>

						<!-- Image lightbox-->
						<a data-fancybox="gallery" data-src="https://lipsum.app/id/4/1024x768">
							<img src="https://lipsum.app/id/4/200x150"/>
						</a>

						<a data-fancybox="gallery" data-src="https://lipsum.app/id/5/1024x768">
							<img src="https://lipsum.app/id/5/200x150"/>
						</a>
					</p>

					<p><a href="#" class="js-toggle" data-item="snippet-fancybox">Code Snippet
							<svg width="16" height="16">
								<use xlink:href="#angle-down"></use>
							</svg>
						</a></p>
					<div class="js-toggle-content" id="snippet-fancybox">
						<pre>
							<code>
&lt;!-- Video lightbox--&gt;
&lt;a data-fancybox=&quot;gallery&quot; data-src=&quot;https://youtu.be/nqye02H_H6I&quot;&gt;
    &lt;img src=&quot;https://lipsum.app/id/3/200x150&quot; /&gt;
&lt;/a&gt;

&lt;!-- Image lightbox--&gt;
&lt;a data-fancybox=&quot;gallery&quot; data-src=&quot;https://lipsum.app/id/4/1024x768&quot;&gt;
    &lt;img src=&quot;https://lipsum.app/id/4/200x150&quot; /&gt;
&lt;/a&gt;
							</code>
						</pre>
					</div>

					<hr>
					<br>

					<h4>Nice Select 2</h4>
					<select>
						<option value="" id="a-select">Select option</option>
						<option value="1">Option 1</option>
						<option value="2">Option 2</option>
					</select>

				</section>
			</div>
		</div>
	</div>

<?php endif; ?>

	<!-- Highlight code blocks: -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/a11y-dark.min.css"
		  integrity="sha512-Vj6gPCk8EZlqnoveEyuGyYaWZ1+jyjMPg8g4shwyyNlRQl6d3L9At02ZHQr5K6s5duZl/+YKMnM3/8pDhoUphg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"
			integrity="sha512-gU7kztaQEl7SHJyraPfZLQCNnrKdaQi5ndOyt4L4UPL/FHDd/uB9Je6KDARIqwnNNE27hnqoWLBq+Kpe4iHfeQ==" crossorigin="anonymous"
			referrerpolicy="no-referrer"></script>
	<script>hljs.highlightAll();</script>

<?php
get_footer();
