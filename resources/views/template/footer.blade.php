<footer class="text-center text-lg-start bg-light text-muted w-100">
    <section
        class="d-flex justify-content-start justify-content-lg-start p-4 border-bottom" >
        <div class="me-3 d-none d-lg-block">
            <span>Get connected with us on social networks:</span>
        </div>
        <div>
            @if(isset($shop_facebook) && $shop_facebook != null)
            <a href="{{ $shop_facebook }}" class="me-2 text-reset footer-link" target="_blank">
                <i class="fab fa-facebook-f" style="color: #3b5998 !important;"></i>
            </a>
            @endif
            @if(isset($shop_google) && $shop_google != null)
            <a href="{{ $shop_google }}" class="text-reset footer-link" target="_blank">
                <i class="fab fa-google" style="color: #0F9D58 !important;"></i>
            </a>
                @endif
        </div>
    </section>
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fas fa-money-check"></i>&nbsp;Pay with
                    </h6>
                    <img src="{{asset('assets/payment.png')}}" alt="payment" class="col-lg-8 w-75">
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        Information
                    </h6>
                    <p>
                        <button class="text-reset footer-link bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#about_us">About Us</button>
                    </p>
                    <p>
                        <button class="text-reset footer-link bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#contact_us">Contact Us</button>
                    </p>
                    <p>
                        <button class="text-reset footer-link bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#delivery_informations">Delivery Infomations</button>
                    </p>

                    <p>
                        <button class="text-reset footer-link bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#terms">Term & Conditions</button>
                    </p>
                    <p>
                        <button class="text-reset footer-link bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#policy">Privacy Policy</button>
                    </p>
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        My Account
                    </h6>
                    <p>
                        <a href="{{ route('my_account', ['state' => 'my_account']) }}" class="text-reset footer-link" >My Account</a>
                    </p>
                    <p>
                        <a href="{{ route('my_account', ['state' => 'orders']) }}" class="text-reset footer-link">Orders</a>
                    </p>
                    <p>
                        <a href="{{ route('my_account', ['state' => 'wishlist']) }}" class="text-reset footer-link">Wish List</a>
                    </p>

                </div>
                @if(isset($shop_info))
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        Contact
                    </h6>
                    @if(isset($shop_info->address)) <p><i class="fas fa-home me-3"></i>{{ $shop_info->address }}  </p>@endif
                    @if(isset($shop_info->address))
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        {{ $shop_info->email }}
                    </p>
                    @endif
                    @if($shop_info->mobile)
                    <p><i class="fas fa-phone me-3"></i>{{ $shop_info->mobile }}</p>
                    @endif
                    @if($shop_info->fax)
                    <p><i class="fas fa-print me-3"></i>{{ $shop_info->fax }}</p>
                    @endif
                </div>
                    @endif
            </div>
        </div>
    </section>
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © {{  date("Y") }}&nbsp;Copyright:
        <a class="text-reset footer-link fw-bold" href="https://yowomart.com/">YOWOMART.COM</a>
    </div>

{{--    models--}}
    <div class="modal fade" id="about_us" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">About Us</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Welcome to YOWOMART.COM where you Shop More & Save More.</h4>
                    <p>It’s nice of you to take the time to get to know us better. Here are some things about us that we thought you might like to know.
                        yowomart.com was launched in 2022 with the objective of making shopping a hassle free experience to anyone who had internet access in Sri Lanka.
                    </p>
<ul>
    <li>                    We are Provide best market space to sell any one or physical shops to sell their product online with best experiences.
    </li>
    <li>                    Any one can earn money with drop shipping in our site.
    </li>
    <li>                    customer can view one product with many customers and choose best one.
    </li>
</ul>
<p>                    We’re always on the mission to provide all our customers the online shopping experience. when shopping online with the best support to make all our customers 100% satisfied by using our services. Therefore, it’s no surprise that we’re a favorite online shopping destination in Sri Lanka.
</p>




                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="contact_us" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contact Us</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(isset($shop_email))&nbsp;Mail to us:<i class="fas fa-paper-plane"></i>&nbsp;{{ $shop_email }} @endif
                        <br>
                    @if(isset($shop_mobile))Call to us:<i class="fas fa-headset"></i>&nbsp;{{ $shop_mobile }} @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delivery_informations" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delivery Informations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
<p>                    Yowomart.com customers can either get their product delivered to their door step with our delivery method. Delivery time is generally 5 to 7 business days.
    In the event where unexpected catastrophes
    erupt we will inform you by email and/or phone call, so that you will be updated on the situation. Further, Yowomart.com
    cannot be held liable for any delays by the delivery parties.
</p>
                    <h5>Undeliverable packages</h5>

                    Occasionally packages are returned to us as undeliverable. When the delivery parties returns an undeliverable package to us, we will contact you via email or telephone.

                    <h6>Why are packages occasionally undeliverable?</h6>
                    <ul>
                        <li>                    Incorrect Address
                            <ul>
                                <li>                    Packages are normally only undeliverable when the address is incorrect- please check your shipping address carefully when placing your order. Should this occur, a redelivery fee will apply. We will try our best to
                                    contact you and double check all orders before processing the order once payment is completed online.
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="terms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Term & Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <h5> ELECTRONIC COMMUNICATIONS</h5>
<p>                    When you visit the Site or send e-mails to us,
    you are communicating with us electronically. You thereby consent to receive communications from us electronically.
    We will either communicate with you by e-mail or post notices on the Site.
    For contractual purposes, you consent to receive communications from us electronically
    and you agree that all agreements, notices, disclosures and other communications that we provide to you electronically
    satisfy any legal requirement that such communications be in writing.
</p>
                    <h5>TRADEMARKS AND COPYRIGHT</h5>
                    <p>                    All content included in or made available through yowomart.com,
                        such as graphics, logos, page headers, button icons, scripts, and service names are registered or unregistered trademarks or trade names of yowo,
                        its affiliates or its Partners in Sri Lanka and/or other countries.
                        The “yowomart.com” and the “yowo” trademarks and/or trade names may only be associated with its products and services and may not be used in
                        connection with any other products and/ or services, in any manner that is likely
                        to cause confusion among customers, or in any manner that disparages or discredits yowomart.com or yowo.
                        All other trademarks not owned by yowo or its Partners or its vendors/merchants that appear on this Site
                        are the property of their respective owners,
                        who may or may not be affiliated with, connected to, or sponsored by yowo, its vendors or its Partners.
                    </p>
                    <p>                    All content included on this Site, such as text, graphics, logos, button icons, images, audio clips, digital downloads,
                        data compilations, and software, is the exclusive property of yowo,
                        its Partners or its vendors/merchants and such content is protected
                        under the Intellectual Property Act of Sri Lanka No 36 of 2003.
                    </p>
                    <h5>                    LICENSE AND SITE ACCESS
                    </h5>
                    <p>                    Subject to your compliance with these Conditions of Use and your payment of any applicable fees,
                        yowomart.com or its content providers grant you a limited, non-exclusive, non-transferable,
                        non-sub-licensable license to access and make personal and non-commercial use of yowomart.com services.
                        You may print and download (page caching) or portions of material from the different areas of the Service
                        solely for your own non-commercial use. This license does not include any resale or commercial use of any yowomart.com Service,
                        or its contents; any collection and use of any product listings, descriptions, or prices; any derivative use of any yowomart.com
                        Service or its contents; any downloading or copying of account information for the benefit of another merchant; or any use of data mining,
                        robots, or similar data gathering and extraction tools. All rights not expressly granted to you in these Conditions of Use are reserved and
                        retained by yowo, or its licensors, suppliers, publishers, rights holders, or other content providers. No yowomart.com Service, nor any part
                        of any yowomart.com Service, may be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial
                        purpose without express written consent of yowomart.com. You may not frame or utilize framing techniques to enclose any trademark, logo,
                        or other proprietary information (including images, text, page layout, or form) of yowomart.com without express written consent.
                        You may not use any Meta tags or any other “hidden text” utilizing yowomart.com’s name or trademarks without the express written consent of yowo.
                        You may not misuse the yowomart.com Services. You may use the yowomart.com Services only as permitted by law. The licenses granted by yowo,
                        terminate if you do not comply with these Terms and Conditions of Use.
                    </p>
                    <h5>                    YOUR ACCOUNT
                    </h5>
                    <p>                    If you use this Site, you are responsible for maintaining the confidentiality of your account and password and
                        for restricting access to your computer. Furthermore, you are responsible for any and all activities that occur under your account
                        or password. You authorize yowo to assume that any person using the Site with your password and user name either is you or is
                        authorized to act for you. You agree to notify yowo immediately of any unauthorized use of your account or any other breach of security.
                        yowo will not be liable for any loss that you may incur as a result of someone else using your password or account either with or without your
                        knowledge. However, you could be held liable for losses incurred by yowo or another party due to someone else using your account or password.
                        yowomart.com does sell products for children, but it sells them to adults, who can purchase with a Credit/Debit card. If you are under the age of 18,
                        you may use yowomart.com only with involvement of a parent or guardian. yowo and its Partners reserve the right to refuse service,
                        terminate accounts, remove or edit content, or cancel orders in their sole discretion.
                    </p>
                    <h5>                    PRODUCT DESCRIPTIONS
                    </h5>
                    <p>                    yowo together with its Partners attempts to be as accurate as possible. However, yowo does not warrant that the product descriptions provided by the Vendors or other content of this Site is accurate, complete, reliable, current, or error-free. If a product offered through the Site itself is not described, and you are not satisfied with the purchase, your sole remedy is to return it, in its unused condition to the Vendor concerned.
                    </p>
                    <p>                    It would be the Vendor’s responsibility to ensure merchantability and fitness for a particular purpose of the products and services they offer through the Site.
                    </p>
                    <h5>                    REVIEWS, COMMENTS, COMMUNICATIONS, AND OTHER CONTENT
                    </h5>
                    <p>                    Visitors may post reviews, comments, photos, and other content and communications, and submit suggestions, ideas, comments, questions, or other information, so long as the content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or otherwise injurious to third parties or objectionable and does not consist of or contain software viruses, political campaigning, commercial solicitation, chain letters, mass mailings, or any form of “spam.” You may not use a false e-mail address; impersonate any person or entity, or other content. yowo reserves the right (but is not obligated) to remove or edit such content, but does not regularly review posted content.
                    </p>
                    <p>                    If you do post content or submit material, and unless we indicate otherwise, you grant yowo a nonexclusive, royalty-free, perpetual, irrevocable, and fully sub-licensable right to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, and display such content throughout the world in any media. You grant yowo and sub licensees the right to use the name that you submit in connection with such content, if they choose. You represent and warrant that you own or otherwise control all of the rights to the content that you post; that the content is accurate; that use of the content you supply does not violate this policy and will not cause injury to any person or entity; and that you will indemnify yowo for all claims resulting from content you supply. yowo has the right but not the obligation to monitor and edit or remove any activity or content. yowo takes no responsibility and assumes no liability for any content posted by you or any third party.
                    </p>
                    <h5>                    COPYRIGHT COMPLAINTS
                    </h5>
                    <p>                    yowo respects the intellectual property of others. If you believe that your work has been copied in a way that constitutes copyright infringement, please report in the manner prescribed below.
                    </p>
                    <h5>                    RISK OF LOSS
                    </h5>
                    <p>                    All items purchased from yowomart.com are made pursuant to a delivery contract. This means that the risk of loss and title for such items pass to you upon our delivery to the carrier.
                    </p>
                    <h5>                    PRICING & FEES
                    </h5>
                    <p>                    The list price displayed for products on our website may or may not represent the full retail price listed on the product itself, suggested by the manufacturer or seller, or estimated in accordance with standard industry practice; or the estimated retail value for a comparably featured item offered elsewhere. The list price may or may not represent the prevailing price in every area on any particular day. Where an item is offered for sale by one of our Vendors, the list price may be decided by yowo and the Vendors at their discretion.
                    </p>
                    <p>                    Despite our best efforts, a small number of the items in our catalog may be incorrectly priced. If an item’s actual price is higher than our stated price, we will, at our discretion, contact you for further instructions, before delivery or cancellation of your order and notify you of such cancellation.
                    </p>
                    <p>                    yowomart.com will charge a convenience fee if necessary, which will be added to the final transaction at the checkout page.
                    </p>
                    <p>                    During promotion months, yowomart.com & it’s partners may charge a convenience fee, which will be added to the final transaction at the checkout page.
                    </p>
                    <h5>                    SHIPPING AND DELIVERY
                    </h5>
                    <p>                    Please review our Delivery Information, which also governs your use of yowomart.com Services, to understand our practices.
                    </p>
                    <p>                    Products must be thoroughly inspected before accepting. If the product is damaged or any parts/content are missing, you must immediately inform the delivery person and not accept the product. If you accept we consider that the product was in good condition and returns/ refund requests will not be accepted by yowomart.com or the merchant/supplier. Delivery time is generally 5 to 7 business days, however times could vary depending on the merchant/sellers and yowomart.com cannot be held liable for any delays. In the event where unexpected catastrophes erupt we will inform you by email and/or phone call, so that you will be updated on the situation. Further, yowomart.com cannot be held liable for any delays by the delivery parties.
                    </p>
                    <p>                    Please ensure to check your ordered product/s for any physical damages prior to accepting the delivery. Please do not accept delivery if there are any damages.
                    </p>
                    <p>                    yowomart.com  will not be liable for goods which are damaged in transit and/or missing content/items if the Proof of Delivery (POD) is signed and the goods are accepted.
                    </p>
                    <p>                    Please be advised that yowomart.com or Delivery Partner (seller accepted) of yowomart.com is not liable for the services such as carrying products to different floors, unboxing the goods, installing the product in a desired location, etc.
                    </p>
                    <h5>                    Undeliverable Packages
                    </h5>
                    <p>                    Occasionally packages are returned to us as undeliverable. When the Delivery service returns an undeliverable package to us, we will contact you via email or telephone.
                    </p>
                    <h6>                    Why are packages occasionally undeliverable?
                    </h6>
                    <h6>                    Incorrect Address
                    </h6>
                    <p>                    Packages are normally only undeliverable when the address is incorrect- please check your shipping address carefully when placing your order. Should this occur, a redelivery fee will apply. We will try our best to contact you and double check all orders before processing the order once payment is completed online.
                    </p>
                    <h6>                    Refused by Recipient
                    </h6>
<p>                    If you are sending a gift, it may be a good idea to let the recipient know that a surprise is on the way, otherwise they may refuse to accept the package believing that it was sent to them in error. In addition it is recommended that you inform yowomart.com as well, so that the delivery agent will know that the recipient is not the person who placed the order. This is necessary for security and fraud reasons. Again, should this occur, a redelivery fee will apply.
</p>
<h5>                    UNAVAILABILITY OF PRODUCT / PRODUCT OUT OF STOCK
</h5>               <p>
                        Inventory of all products advertised on yowomart.com are not managed or maintained by yowomart.com. yowomart.com only acts as an intermediary between the customer and the sellers for such products. These products may not be available (run out of stock) from time to time due to overselling by the sellers, however the product may be available for purchase on yowomart.com if the supplier has not promptly informed us of the fact that the product is unavailable for them to supply us. In such circumstances yowomart.com does not accept any liability whatsoever.
                        In the event of a stock unavailability, yowomart.com will inform the customer within 3 working days, and the payment can be refunded within 10 working days.
                        Customer acknowledges and agrees that the only remedy available for unavailability of product is the refund of the money paid.
                        Placement of an order including the payment of the order value by the Customer will be construed as an offer. When you place an order to purchase a product from us, you will receive an e-mail confirming receipt of your order and containing the details of your order (the “Order Confirmation E-mail”). The Order Confirmation E-mail is acknowledgement that we have received your order and has been passed for processing and does not confirm acceptance of your offer to buy the product(s) ordered. We only accept your offer, when we have commenced delivery after the supplier has released the product.

                    </p>
                    <h5>APPLICABLE LAW</h5>
                    <p>                    The Site and the Terms and Conditions herein contained shall be governed and construed in accordance with the laws of Sri Lanka. By accessing the Site, you agree that the laws of Sri Lanka will govern all matters relating to the Site without giving effect to any principles of conflict of laws.
                    </p>
                    <h5>                    DISPUTES
                    </h5>
                    <p>                    You agree that any legal action, dispute or proceeding between yowo and you for any purpose concerning the Terms and Conditions or in relation to your visit to the Site or the products you purchase through the Site or the parties’ obligation hereunder shall be governed by the Arbitration Act No 11 of 1995 in Sri Lanka. Any cause of action or claim you may have with respect to the Services must be commenced within one (01) year after the claim or cause of action arises or such claim or cause of action is barred.
                    </p>
                    <h5>                    SITE POLICIES, MODIFICATION, AND SEVERABILITY
                    </h5>
                    <p>                    Please review all other policies, such as our privacy policy, return policy, delivery details,posted on this Site. These policies also govern your visit to the Site. We reserve the right to make changes to our Site, policies, and to the Terms and Conditions at any time. If any of these Terms and Conditions shall be deemed unlawful, void, or for any reason unenforceable, then that provision shall be deemed severable from these Terms and Conditions and shall not affect the validity and enforceability of any remaining provisions.
                    </p>
                    <h5>                    CONFLICT OF TERMS
                    </h5>
                    <p>                    If there is a conflict or contradiction between the terms and conditions in yowomart.com and any other relevant terms and conditions, policies or notices, the other relevant terms and conditions, policies or notices which relate specifically to a particular section or module in yowomart.com shall prevail in respect of your use of the relevant section or module of the website.
                    </p>

                    <hr>
                    <p> yowomart.com is an e-commerce site that markets products online for the consumer and any parties can sell product this site. The customer can order goods online and have them delivered to their doorstep anywhere in the island.

                        By using yowomart.com (hereinafter called and referred to as “yowomart.com”, ,"yowo",“website” or the “Site”), you agree to these conditions. Please read them carefully.

                        If you do not wish to be bound by these Terms and Conditions, You may not access or use the Services offered on yowomart.com. If You utilize the Service in a manner inconsistent with these Terms and Conditions, yowo Trades (hereinafter called and referred to as “yowo”) may terminate your access, block your future access and/or seek such additional relief as the circumstances of your misuse. yowo may modify the Terms and Conditions at any time without any prior notice, and such modification shall be effective immediately upon posting of the modified Terms and Conditions. You agree to review the Terms and Conditions periodically to be aware of such modifications and your continued access or use of the Service shall be deemed your conclusive acceptance of the modified Terms and Conditions.
                    </p>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="policy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Privacy Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
<p>                    At yowomart.com (hereinafter referred to as “yowomart.com”, "yowo",“us”, “we”, “our”), we are committed to safeguarding and preserving the privacy of our visitors and to comply with any applicable data protection and privacy laws. The Privacy Policy applies to all Customers and Users (collectively referred to as “Users”). In addition this Privacy Policy applies to all products and services provided by yowomart.com (hereinafter referred to as “yowomart.com” or the “Site”, “website”).
</p>
                    <p>                    This Privacy Policy explains what happens to any personal data that you provide to us, or that we collect from you whilst you visit our Site. We do update this Policy from time to time so please do review this Policy regularly.
                    </p>
                    <h5>                    Information we collect
                    </h5>
<p>                    In running and maintaining our Site we may collect and process the following data about you:
</p>
                    <ol>
                        <li>                    Information about your use of our Site including details of your visits such as pages viewed and the resources that you access. Such information includes traffic data, location data and other communication data.
                        </li>
                        <li>                    Information provided voluntarily by you. For example, when you register for information or make a purchase.
                        </li>
                        <li>                    Information that you provide when you communicate with us by any means.
                        </li>
                    </ol>
<h5>                    Security
</h5>
<p>                    We know how important it is to feel safe when using your credit/debit card online. This is why we have employed the best encryption methods available today. You can feel confident about the safety of your credit/debit card when shopping on our site.
</p>
<p>                    We accept payments through mobile payment methods,bank web payment method, Visa, MasterCard and American Express debit and/or credit cards with payhere online payment gateway managed and run by payhere in Sri Lanka. We do not keep customers credit/debit card information on file or store in our database. The Bank verify credit/debit card information during the transaction. When passing information we use SSL to encrypt all data.
</p>
<h5>                    Use of cookies
</h5>
<p>                    Cookies provide information regarding the computer used by a visitor. We may use cookies where appropriate to gather information about your computer in order to assist us in improving our Website.
</p>
<p>                    We may gather information about your general internet use by using the cookie. Where used, these cookies are downloaded to your computer and stored on the computer’s hard drive. Such information will not identify you personally. It is statistical data. This statistical data does not identify any personal details whatsoever
</p>
<p>                    You can adjust the settings on your computer to decline any cookies if you wish. This can easily be done by activating the reject cookies setting on your computer.
</p>
<p>                    Our advertisers may also use cookies, over which we have no control. Such cookies (if used) would be downloaded once you click on advertisements on our website.
</p>
<h5>                    Use of your information
</h5>
<p>                    We use the information that we collect from you to provide our services to you. In addition to this we may use the information for one or more of the following purposes:
</p>
                    <ol>
                        <li>                    To provide information to you that you request from us relating to our products or services.
                        </li>
                        <li>                    To provide information to you relating to other products that may be of interest to you. Such additional information will only be provided where you have consented to receive such information.
                        </li>
                        <li>                    To inform you of any changes to our Website, services or goods and products.
                        </li>
                        <li>                    Provide information to sellers your item bought.for deliver information
                        </li>
                        <li>                    If you have previously purchased goods or services from us, we may provide to you details of similar goods or services, or other goods and services, which you may be interested in.
                        </li>
                        <li>                    Where your consent has been provided in advance we may allow selected Third Parties to use your data to enable them to provide you with information regarding unrelated goods and services which we believe may interest you. Where such consent has been provided it can be withdrawn by you at any time.
                        </li>
                    </ol>


<h5>                    Storing your personal data
</h5>
<p>                    In operating our Website it may become necessary to transfer data that we collect from you to Third Parties. By providing your personal data to us, you agree to this transfer, storing or processing. We do our utmost to ensure that all reasonable steps are taken to make sure that your data is treated stored securely.
</p>
<p>                    Unfortunately the sending of information via the internet is not totally secure and on occasion such information can be intercepted. We cannot guarantee the security of data that you choose to send us electronically. Sending such information is entirely at your own risk.
</p>
<h5>                    Disclosing your information
</h5>
<p>                    We will not disclose your personal information to any other party other than in accordance with this Privacy Policy and in the circumstances detailed below:
</p>
<p>                    In the event that we sell any or all of our business to the buyer.
</p>
<p>                    Where we are legally required by law to disclose your personal information.
</p>
<p>                    To further fraud protection and reduce the risk of fraud.
</p>
<h5>                    Third party links
</h5>
<p>                    On occasion we include links to third parties on this Website. Where we provide a link it does not mean that we endorse or approve that site’s policy towards visitor privacy. You should review their privacy policy before sending them any personal data.
</p>
                </div>
            </div>
        </div>
    </div>

</footer>
