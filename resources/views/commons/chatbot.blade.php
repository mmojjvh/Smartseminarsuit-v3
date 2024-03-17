<section class="faq-section">
    <div class="faq-box">
        <div class="faq-header">
            <button class="faq-close"><i class="fa fa-close"></i></button>
        </div>
        <div class="faq-list">
            @foreach($faqs as $index => $faq)
            <div class="faq-item" id="faq-{{$faq->id}}" data-id="{{$faq->id}}" data-answer="{{$faq->answer}}" data-question="{{$faq->question}}">
                <strong>FAQ #{{$faq->sequence}}</strong><br>{{$faq->question}}
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="book-section">
    <div class="book-box">
        <div class="book-header">
            <button class="book-close"><i class="fa fa-close"></i></button>
            <h5 class="book-title">Appointment Form</h5>
        </div>
        <div class="book-body">
            <input type="text" name="name" placeholder="Full Name" class="book-input" id="book-name">
            <input type="email" name="email" placeholder="Email Address" class="book-input" id="book-email">
            <input type="tel" name="contact" placeholder="Contact Number" class="book-input" id="book-contact">
            <input type="date" name="date" placeholder="Date" class="book-input" id="book-date">
            <textarea name="details" placeholder="Details about service you want to acquire E.g. Tooth Extraction" class="book-input book-details" id="book-details" cols="30" rows="3"></textarea>
        </div>
        <div class="book-footer">
            <button class="book-appointment-btn" id="book-appointment-btn">
                Book Appointment
            </button>
        </div>
    </div>
</section>
<section class="chat-section">
    <div class="chat-bubble-btn">
        <i class="fa fa-wechat"></i> ChatBot
    </div>
    <div class="chat-box">
        <div class="chat-header">
            <button class="chat-close"><i class="fa fa-close"></i></button>
            <div class="row">
                <div class="col-xs-2">
                    <img src="{{asset('vet-clinic/images/face0.jpg')}}" class="chat-image" alt="avatar">
                </div>
                <div class="col-xs-6">
                    <div class="chat-title">
                        <p>ChatBot <br>
                            <small class="online text-success"> Online</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-body">
        </div>
        <div class="chat-sub-footer">
            <button class="faq-btn">FAQs</button>
            <button class="book-btn">Book an Appointment</button>
        </div>
        <div class="chat-footer">
            <input type="text" class="chat-message" id="input-message">
            <button class="chat-send" id="btn-send">
                <i class="fa fa-send-o"></i>
            </button>
        </div>
    </div>
</section>