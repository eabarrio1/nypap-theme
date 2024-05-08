<?php
			$pageID = $thePage->ID;					
			$content = $thePage->post_content;
			$title = $thePage->post_title;
			$content = apply_filters('the_content', $content);
?>

			<div class="section group page-summary division">					
				<div class="<?php echo $thePage->post_name;?>-callout callout clearfix">	

					<div class="group section">			
						<div class="col span_1_of_6">
							<div class="section-tag"><?php echo $title;?></div>
						</div>

						<div class="col span_4_of_6">
							<!-- <div class="group section"> -->
								<?php echo $content;?>						
								<p><a href="<?php echo get_permalink($pageID);?>" class="block-link">read more ></a></p>
							<!-- </div> -->
						</div>
					</div>
				
<?php
					if ($title == "Donate") {
?>	
						<div class="section section-tight group">	
							<div class="col span_5_of_6_offset_1"><div class="tags">Contribute Now:</div></div>
						</div>	
						<div class="section group">
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							
								<div class="col span_3_of_6 offset_1">

									<input TYPE="hidden" name="charset" value="utf-8">
									<input type="hidden" name="business" id="edit-business" value="info@nypap.org"  />
									<input type="hidden" name="cmd" value="_donations"  />
									<input type="hidden" name="item_name" value="NYPAP.org Donation"  />
									<input type="hidden" name="no_shipping" id="edit-no-shipping" value="1"  />
									<input type="hidden" name="return" id="edit-return" value="http://www.nypap.org/donation/thanks"  />
									<!-- <div class="form-item" id="edit-currency-code-wrapper"> -->
									 <!-- <label for="edit-currency-code">Currency: </label> -->
									 <!-- <select name="currency_code" class="form-select" id="edit-currency-code" ><option value="USD">U.S. Dollar</option><option value="AUD">Australian Dollar</option><option value="GBP">British Pound</option><option value="CAD">Canadian Dollar</option><option value="CZK">Czech Koruna</option><option value="DKK">Danish Kroner</option><option value="EUR">Euro</option><option value="HKD">Hong Kong Dollar</option><option value="HUF">Hungarian Forint</option><option value="ILS">Israeli New Shekel</option><option value="JPY">Japanese Yen</option><option value="MXN">Mexican Peso</option><option value="NZD">New Zealand Dollar</option><option value="NOK">Norwegian Kroner</option><option value="PLN">Polish Zlotych</option><option value="SGD">Singapore Dollar</option><option value="SEK">Swedish Kronor</option><option value="CHF">Swiss Franc</option></select> -->
									 <!-- <div class="description">We accept payments in these currencies.</div> -->
									<!-- </div> -->
									<!-- <div class="form-item" id="edit-amount-wrapper"> -->
									 <!-- <label for="edit-amount">Amount: <span class="form-required" title="This field is required.">*</span></label> -->
									 <input type="text" maxlength="255" name="amount" id="edit-amount" size="40" value="50.00" class="form-text required" />
									 <!-- <div class="description">Enter the amount you wish to donate.</div> -->
									<!-- </div> -->
									<input type="hidden" name="notify_url" id="edit-notify-url" value="http://www.nypap.org/ipn/donation"  />
									<input type="hidden" name="custom" id="edit-custom" value="0"  />
									<input type="hidden" name="form_build_id" id="form-8izE_XquX58yvm_Rnh9LfLOunI0VBDTA2gEYBFq4cyY" value="form-8izE_XquX58yvm_Rnh9LfLOunI0VBDTA2gEYBFq4cyY"  />
									<input type="hidden" name="form_id" id="edit-donation-form-build" value="donation_form_build"  />
								</div>
								<div class="col span_1_of_6">
									<input type="submit" name="submit" id="edit-submit" value="Donate"  class="button red-button form-submit" />
								</div>							
							</form>
						</div>
<?php
					}
?>

				</div>
			</div>
					<!-- to do: another offset class -->
					<!-- <div class="col span_1_of_6">&nbsp;</div> -->
