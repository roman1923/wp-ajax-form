<?php get_header(); ?>

<section class="contact-form--section">
    <div class="container">
        <div class="contact-form--block">       
            <h1 class="form-title">Reach Out and <br><span>Connect</span> With Us</h1>
            <p class="form-subtitle">Bridging Your Ideas with Our Expertise</p>

            <form id="form" class="form">

                <input type="text" name="form_name" id="form_name" class="required form_name" placeholder="Name *" />

                <input type="email" name="form_email" id="form_email" class="required form_email" placeholder="E-mail *" />

                <input type="tel" name="form_tel" id="form_tel" class="required form_tel" placeholder="Phone *" />

                <input type="password" name="form_password" id="form_password" class="required form_password" placeholder="Password *" />

                <select name="form_city" id="form_city" class="required form_city">
                    <option value="" selected disabled>Choise Your City *</option>
                    <option value="New York">New York</option>
                    <option value="Las Vegas">Las Vegas</option>
                    <option value="Lublin">Lublin</option>
                </select>

                <div class="form-bottom">

                    <div class="checkbox-block">
                        <input type="checkbox" name="form_privacy_policy" id="form_privacy_policy" class="required form_privacy_policy" />
                        <label for="form_privacy_policy">I have read and accepted <span>privacy policy</span></label>
                    </div>

                    <input type="submit" id="form_submit" class="button form_button" value="Submit" />
                </div>
            </form>
        </div>
    </div>
</section>


<?php get_footer(); ?>

