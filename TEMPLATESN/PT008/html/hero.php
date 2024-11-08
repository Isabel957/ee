
<div class="c-hero c-hero--multiple" id="hero">
  <picture class="c-hero__pic">
    <source media="(min-width: 700px)" srcset="images/components/hero/hero-lg.webp, images/components/hero/hero-lg@2x.webp 2x" type="image/webp"/><img class="c-hero__img" src="images/components/hero/hero-sm.webp" srcset="images/components/hero/hero-sm@2x.webp 2x" alt="Smartphone showing results of quotes for car insurance" width="360" height="175"/>
  </picture>
  <div class="c-hero__wrapper o-wrapper o-wrapper--large">
    <h1 class="c-hero__title">Total coverage. One source.</h1>
    <p class="c-hero__text">All your insurance needs in one place.</p>
    <div class="c-hero__content">
      <form class="c-hero-form js-form" action="{form-lp}" method="post">
        <fieldset class="c-hero-form__content">
          <legend class="c-hero-form__title">Select a product to start:</legend>
          <div class="c-hero-form__radios">
            <div class="c-hero-form__radio">
              <input class="u-hidden-visually c-hero-form__radio-input" id="productTypeCar" type="radio" name="productType" required="required" value="A"/>
              <label class="c-hero-form__radio-label" for="productTypeCar"> <span class="o-icon c-hero-form__radio-icon">
                  <svg aria-hidden="true" focusable="false" role="img">
                    <use xlink:href="images/icons/icons.svg#icon-auto"></use>
                  </svg></span><span class="c-hero-form__radio-text">Auto</span>
              </label>
            </div>
            <div class="c-hero-form__radio">
              <input class="u-hidden-visually c-hero-form__radio-input" id="productTypeHome" type="radio" name="productType" value="H"/>
              <label class="c-hero-form__radio-label" for="productTypeHome"> <span class="o-icon c-hero-form__radio-icon">
                  <svg aria-hidden="true" focusable="false" role="img">
                    <use xlink:href="images/icons/icons.svg#icon-home"></use>
                  </svg></span><span class="c-hero-form__radio-text">Homeowner</span>
              </label>
            </div>
            <div class="c-hero-form__radio">
              <input class="u-hidden-visually c-hero-form__radio-input" id="productTypeRenters" type="radio" name="productType" required="required" value="R"/>
              <label class="c-hero-form__radio-label" for="productTypeRenters"> <span class="o-icon c-hero-form__radio-icon">
                  <svg aria-hidden="true" focusable="false" role="img">
                    <use xlink:href="images/icons/icons.svg#icon-renters"></use>
                  </svg></span><span class="c-hero-form__radio-text">Renters</span>
              </label>
            </div>
            <div class="c-hero-form__radio">
              <input class="u-hidden-visually c-hero-form__radio-input" id="productTypeCommercial" type="radio" name="productType" value="CI"/>
              <label class="c-hero-form__radio-label" for="productTypeCommercial"> <span class="o-icon c-hero-form__radio-icon">
                  <svg aria-hidden="true" focusable="false" role="img">
                    <use xlink:href="images/icons/icons.svg#icon-commercial"></use>
                  </svg></span><span class="c-hero-form__radio-text">Commercial</span>
              </label>
            </div>
            <div class="c-hero-form__radio">
              <input class="u-hidden-visually c-hero-form__radio-input" id="productTypeOther" type="radio" name="productType" value="O"/>
              <label class="c-hero-form__radio-label" for="productTypeOther"> <span class="o-icon c-hero-form__radio-icon">
                  <svg aria-hidden="true" focusable="false" role="img">
                    <use xlink:href="images/icons/icons.svg#icon-other"></use>
                  </svg></span><span class="c-hero-form__radio-text">Other</span>
              </label>
            </div>
            <div class="c-hero-form__radio-error"></div>
          </div>
        </fieldset>
        <div class="c-hero-form__controls">
          <div class="c-hero-form__item">
            <label class="c-hero-form__label" for="#zipcode">Zip Code</label>
            <textarea class="c-hero-form__input c-hero-form__zipcode js-valid-zipcode js-only-numbers" id="zipcode" type="text" name="zipcode" maxlength="5" minlength="3" required="required" autocomplete="postal-code" inputmode="numeric" aria-label="Enter you zip code"></textarea>
          </div>
          <!--input(type='hidden' name='media_code' value='{media-code}')-->
          <!--input(type='hidden' name='contact_phone' value='{phone-number}')-->
          <button class="c-hero-form__submit" type="submit"><span>Begin Your Quote</span><img src="images/components/hero/loading.svg" alt="Loading" width="20" height="20"/></button>
        </div>
      </form>
    </div>
  </div>
</div>