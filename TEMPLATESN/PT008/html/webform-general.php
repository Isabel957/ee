
<div class="c-form-header">
  <picture class="c-form-header__banner">
    <source media="(min-width: 700px)" srcset="images/components/hero/hero-form-lg.webp, images/components/hero/hero-form-lg@2x.webp 2x" type="image/webp"/><img class="c-form-header____img" src="iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8/5+hHgAHggJ/PchI7wAAAABJRU5ErkJggg==" alt="Smartphone showing results of quotes for car insurance" width="1" height="1"/>
  </picture>
  <div class="c-form-header__container o-wrapper o-wrapper--large">
    <h2 class="c-form-header__title">START YOUR QUOTE!</h2>
    <h3 class="c-form-header__title c-form-header__title--product">Product:
      <input class="c-form-header__title_input" readonly="readonly" type="text" name="product-name" value="{product-name}"/>
    </h3>
  </div>
</div>
<div class="c-page-quote">
  <div class="c-page-quote__container o-wrapper o-wrapper--large"> 
    <form class="c-page-quote__form c-page-quote-form js-form" action="{url-rater}" method="post">
      <input type="hidden" name="type_insurance" value="{type_insurance}"/>
      <div class="c-page-quote-form__item c-page-quote-form__item_break">
        <label class="c-page-quote-form__label" for="form-gender">Gender</label>
        <select class="c-page-quote-form__select js-valid-select" id="form-gender" name="lead[gender]" required="required">
          <option value="" disabled="disabled" selected="selected">Select</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="NonBinary">Non Binary</option>
        </select>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-fname">First Name</label>
        <input class="c-page-quote-form__input js-only-letters js-valid-first-name" id="form-fname" type="text" name="lead[first_name]" required="required"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-lname">Last Name</label>
        <input class="c-page-quote-form__input js-only-letters js-valid-last-name" id="form-lname" type="text" name="lead[last_name]" required="required"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-email">Email</label>
        <input class="c-page-quote-form__input js-valid-email" id="form-email" type="email" name="lead[email]" required="required"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-phone">Phone Number</label>
        <input class="c-page-quote-form__input js-only-phone js-valid-phone" id="form-phone" type="tel" name="lead[phone]" maxlength="12" required="required"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-address">Street Address</label>
        <input class="c-page-quote-form__input" id="form-address" type="text" name="lead[street]" data-validate-field="address" required="required"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-apt">Apt/Suite</label>
        <input class="c-page-quote-form__input" id="form-apt" type="text" name="lead[apt]"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-zipcode">ZIP CODE</label>
        <input class="c-page-quote-form__input js-valid-zipcode js-only-numbers" value="{zipcode}" id="form-zipcode" type="tel" onfocusout="getCity()" name="lead[zipcode]" maxlength="5" data-validate-field="zipcode" required="required"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-cityState">City, State</label>
        <input class="c-page-quote-form__input js-only-letters" id="form-cityState" type="text" name="city" readonly="readonly" value="{city}"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-insured">Are you currently Insured?</label>
        <select class="c-page-quote-form__select" id="form-insured" name="coverage[current_recent_carrier]" data-validate-field="insured" required="">
          <option value="" disabled="" selected="">Select</option>
          <option value="No">No</option>
          <option value="Yes">Yes</option>
        </select>
      </div>
      <div class="c-page-quote-form__legal-text" id="comunication-consent-text">
        <p>By clicking Submit, I agree to the <strong>InsureOne Insurance</strong> <a href="https://www.insureone.com/privacy-policy/" target="_blank">Privacy Policy</a> and <a href="https://www.insureone.com/terms-of-use/" target="_blank">Terms of Use</a>, and I consent to <strong>InsureOne</strong> or their successors contacting me with offers about their services. I agree that such contact may occur via automated system or pre-recorded message and I understand giving consent to contact is not required for any purchase. I also give my express written consent to be contacted at the mobile phone number provided above for marketing purposes by call, text, or automated telephone dialing system, including with an artificial or prerecorded voice, which may leave a message. Message and data rate may apply. Message frequency varies. Text HELP for help and STOP to cancel at any time. I understand that I am providing this consent even if my telephone number is currently listed on a federal, state, internal, or corporate Do-Not-Call list. I understand that I do not have to agree to receive these types of calls or text messages as a condition of purchasing any goods or services. This site is protected by reCAPTCHA and the <a href="https://policies.google.com/privacy" target="_blank">Google Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank">Terms of Use apply</a>.</p>
      </div>
      <div class="c-page-quote-form__controls">
        <button class="c-page-quote-form__submit c-page-quote-form__control js-submit-button" type="submit"><span>Submit</span><img src="images/components/hero/loading.svg" alt="Loading" width="20" height="20"/></button>
      </div>
    </form>
  </div>
</div>
<script>
  function getCity() {
  
      var zipcode = document.getElementById("form-zipcode").value ;
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.open('GET', "https://www.confiejarvis.com/thor/get/"+zipcode+".json", true);
      xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4) {
              if(xmlhttp.status == 200) {
                  var obj = JSON.parse(xmlhttp.responseText);                        
                  document.getElementById("form-cityState").value = obj.data.City +", "+ obj.data.State; 
              }else{
                  document.getElementById("form-cityState").value = "";  
              }
          }
      };
      xmlhttp.send(null);
  }
      
</script>