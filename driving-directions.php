<?php
/*
Template Name: Contact
*/
error_reporting(E_ALL);
ini_set('display_errors','1');
?>

<?php //get_header();?>

<link rel="stylesheet" id="contact-css-css" href="http://transvideo.com/wp-content/themes/transvideo/library/css/contact.css" type="text/css" media="all">
            <div class="content">

                            <div id="">
                                    <h1 class="page-title"></h1>
									<div class="hr-bar"></div>
                                    <div class="row">
                                        <div>
                                            <div id="dynamicClock"></div>
                                            <script id="standardClockTemplate" type="text/template">
                                                <% var injectSpan = new RegExp('(\\d\\d)( [A-Z][A-Z])?$'); %>
												<div class="<%= setting %>">	
												<p class="city"><span>Local time in:</span> <%= city %>, <%= state %></p>
													<ul>
														<li class="time"><%= date.pattern(display).replace(injectSpan, '<span class="seconds">$1</span>$2') %> (<%= displayFormat %>)</li>
														<li class="date"><%= date.pattern("l, F jS, Y") %></li>
														<li class="link-message"><%= linkMessage %></li>
													</ul>
												</div>

                                            </script>
                                        </div><!--
                                        
                                        --><div>
											<p class="share">Share and Enjoy</p>
											<ul class="contact-social-links">
												<li>
													<a href="https://twitter.com/transvideo">
													</a>
												</li>
												<li>
													<a href="https://www.facebook.com/transvideostudios">
													</a>
												</li>
												<li>
													<a href="http://www.linkedin.com/company/transvideo-studios">
														<img src="http://trasnvideo.com/wp-content/themes/transvideo/library/images/icons/linkedin.gif" alt="LinkedIn" title="LinkedIn" width="15" height="15">
													</a>
												</li>
												<li>
													<a href="http://www.youtube.com/user/transvideostudios">
														<img src="http://transvideo.com/wp-content/themes/transvideo/library/images/icons/youtube.gif" alt="YouTube" title="YouTube" width="14" height="15">
													</a>
												</li>
												<li>
													<a href="http://vimeo.com/transvideo">
													</a>
												</li>
                                        	</ul>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div id="map">
                                            <h5>Driving Directions</h5>
											<div id="map-canvas"></div>
											<!-- <a href="https://www.google.com/maps?q=Transvideo+Studios&#38;amp;hl=en&#38;amp;sll=37.39488,&#45;122.080819&#38;amp;sspn=0.014951,0.019097&#38;amp;hq=Transvideo+Studios&#38;amp;t=m&#38;amp;z=16&#38;amp;iwloc=A" target="_blank"><img class="Col5 last" style="height:288px; width:480px; background&#45;color:#inherit; color:#000000; margin:5px 0 25px 0;" src="<?php //echo get_template_directory_uri();?>/library/images/map.png"></a> -->

                                            <form id="calculate-route" name="calculate-route" action="#" method="get" >
												<input id="fromAddress" name="fromAddress" type="text" size="40"  value="" />
												<input type="submit" value="GO" />
                                            </form>
											<div id='print-directions'>
												<a id="print-icon" href="javascript:void()"><img src="http://transvideo.com/wp-content/themes/transvideo/library/images/icons/print_icon.gif" title="Print" alt="Print Icon" />&nbsp;Print these directions</a>&nbsp;
												<a id="open-google-maps" href="javascript:void()">View directions in Google Maps</a>
											</div>
										
											<div id="directions"></div>
											<p id="error"></p>
                                        </div><!--
										--><div class="contact-facade">
											<img src="http://transvideo.com/wp-content/themes/transvideo/library/images/studio/contact_facade.png" width="459" height="287" />
											<!--

											<p>Built on a foundation that provides daily broadcast origination for major TV and cable networks (CNN, Fox, CBS, ABC, etc), and with its own internal creative agency, Picturelab, T												ransvideo Studios offers an advanced production capability delivering cinema quality, with individualized brand integrity unique to each client’s needs.
											</p>
											<p>Online video, TV spots, documentaries... for clients large and small, including start-ups through fortune 500’s. Clients like Google, Facebook, Apple, NASA and other organizations 												that want to communicate their stories, products, or services...
											</p>
											-->
										</div>
                                    </div>
                            </div> <!-- end article -->
            </div> <!-- end #content -->
<?php //get_footer(); ?>
<script type="text/javascript" src="http://transvideo.com/wp-content/themes/transvideo/library/js/iv/jquery-1.9.0.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/30/6/common.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/30/6/util.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/30/6/geocoder.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/30/6/stats.js"></script>
<script type="text/javascript" src="http://transvideo.com/wp-includes/js/comment-reply.min.js"></script>
<script type="text/javascript" src="http://transvideo.com/wp-content/themes/transvideo/library/js/scripts.js"></script>
<script type="text/javascript" src="http://transvideo.com/wp-content/themes/transvideo/library/js/global.js"></script>
<script type="text/javascript" src="http://transvideo.com/wp-content/themes/transvideo/library/js/sidebar.js"></script>
<script type="text/javascript" src="http://transvideo.com/wp-includes/js/underscore.min.js"></script>
<script type="text/javascript" src="http://transvideo.com/wp-content/themes/transvideo/library/js/clock.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASUd6qi6PzDuN3xl4vSpShKdTdvWSc6p4&amp;sensor=false"></script>
<script type="text/javascript" src="http://transvideo.com/wp-content/themes/transvideo/library/js/contact.php"></script>
