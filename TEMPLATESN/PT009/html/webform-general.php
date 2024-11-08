
<div class="c-form-header">
  <picture class="c-form-header__banner">
    <source media="(min-width: 700px)" srcset="images/components/hero/hero-form-lg.webp, images/components/hero/hero-form-lg@2x.webp 2x" type="image/webp"/><img class="c-form-header____img" src="iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8/5+hHgAHggJ/PchI7wAAAABJRU5ErkJggg==" alt="Smartphone showing results of quotes for car insurance" width="1" height="1"/>
  </picture>
  <div class="c-form-header__container o-wrapper o-wrapper--large">
    <h2 class="c-form-header__title">¡COMIENCE A COTIZAR!  </h2>
    <h3 class="c-form-header__title c-form-header__title--product">Producto:
      <input class="c-form-header__title_input" readonly="readonly" type="text" name="product-name" value="{product-name}"/>
    </h3>
  </div>
</div>
<div class="c-page-quote">
  <div class="c-page-quote__container o-wrapper o-wrapper--large"> 
    <form class="c-page-quote__form c-page-quote-form js-form" action="{url-rater}" method="post">
      <input type="hidden" name="type_insurance" value="{type_insurance}"/>
      <div class="c-page-quote-form__item c-page-quote-form__item_break">
        <label class="c-page-quote-form__label" for="form-gender">Género </label>
        <select class="c-page-quote-form__select js-valid-select" id="form-gender" name="lead[gender]" required="required">
          <option value="" disabled="disabled" selected="selected">Elegir</option>
          <option value="Male">Masculino </option>
          <option value="Female">Femenino</option>
          <option value="NonBinary">No binario</option>
        </select>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-fname">Nombre</label>
        <input class="c-page-quote-form__input js-only-letters js-valid-first-name" id="form-fname" type="text" name="lead[first_name]" required="required"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-lname">Apellido</label>
        <input class="c-page-quote-form__input js-only-letters js-valid-last-name" id="form-lname" type="text" name="lead[last_name]" required="required"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-email">Correo electrónico</label>
        <input class="c-page-quote-form__input js-valid-email" id="form-email" type="email" name="lead[email]" required="required"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-phone">Número telefónico</label>
        <input class="c-page-quote-form__input js-only-phone js-valid-phone" id="form-phone" type="tel" name="lead[phone]" maxlength="12" required="required"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-address">Dirección</label>
        <input class="c-page-quote-form__input" id="form-address" type="text" name="lead[street]" data-validate-field="address" required="required"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-apt">Apt/Suite</label>
        <input class="c-page-quote-form__input" id="form-apt" type="text" name="lead[apt]"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-zipcode">Código Postal</label>
        <input class="c-page-quote-form__input js-valid-zipcode js-only-numbers" value="{zipcode}" id="form-zipcode" type="tel" onfocusout="getCity()" name="lead[zipcode]" maxlength="5" data-validate-field="zipcode" required="required"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-cityState">Ciudad, Estado</label>
        <input class="c-page-quote-form__input js-only-letters" id="form-cityState" type="text" name="city" readonly="readonly" value="{city}"/>
      </div>
      <div class="c-page-quote-form__item">
        <label class="c-page-quote-form__label" for="form-insured">¿Actualmente cuenta con un seguro? </label>
        <select class="c-page-quote-form__select" id="form-insured" name="coverage[current_recent_carrier]" data-validate-field="insured" required="">
          <option value="" disabled="" selected="">Elegir </option>
          <option value="No">No</option>
          <option value="Yes">Si</option>
        </select>
      </div>
      <div class="c-page-quote-form__legal-text" id="comunication-consent-text">
        <p>Al hacer clic en Enviar, acepto la  <a href="https://www.insureone.com/privacy-policy/" target="_blank">Política de privacidad</a> y las <a href="https://www.insureone.com/terms-of-use/" target="_blank">Condiciones de uso</a> de <strong>InsureOne Insurance</strong>, y doy mi consentimiento para que <strong>InsureOne</strong> o sus filiales se pongan en contacto conmigo para ofrecerme sus servicios, acepto que dicho contacto pueda producirse a través de un sistema automatizado o un mensaje pregrabado y entiendo que dar mi consentimiento para que se pongan en contacto conmigo no es necesario para ninguna compra, pero doy mi consentimiento expreso por escrito para que se pongan en contacto conmigo en el número de teléfono móvil proporcionado anteriormente con fines de marketing a través de una llamada de texto o un sistema de marcación telefónica automatizado, incluso con un mensaje artificial o pregrabado, que puede dejar un mensaje. Pueden aplicarse tarifas de mensajes y datos. La frecuencia de los mensajes varía. Envíe un mensaje con la palabra AYUDA para obtener ayuda y STOP para cancelar en cualquier momento. Entiendo que estoy proporcionando este consentimiento, incluso si mi número de teléfono está actualmente en una lista federal, estatal, interna o corporativa de No Llamar (Do Not Call List). Entiendo que no tengo que aceptar recibir este tipo de llamadas o mensajes de texto como condición para comprar cualquier bien o servicio. Este sitio está protegido por reCAPTCHA y se aplican la <a href="https://policies.google.com/privacy" target="_blank">Política de privacidad</a> y las <a href="https://policies.google.com/terms" target="_blank">Condiciones de uso de Google.</a>    </p>
      </div>
      <div class="c-page-quote-form__controls">
        <button class="c-page-quote-form__submit c-page-quote-form__control js-submit-button" type="submit"><span>Enviar</span><img src="images/components/hero/loading.svg" alt="Loading" width="20" height="20"/></button>
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