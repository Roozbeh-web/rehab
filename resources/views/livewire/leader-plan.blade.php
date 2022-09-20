<div>
    <div>
        <div class="plans-user-details-container">
            <h1>برنامه {{$user['first_name']}} {{$user['last_name']}}</h1>
            <div class="plans-user-details-second-container">
                <span>مواد مورد مصرف: </span>
                @foreach ($user['drugs'] as $drug)
                    <p>{{$drug}}.</p>
                @endforeach
            </div>
            <p>شماره تماس: {{$user['phone']}}</p>
        </div>
        <div class="leader-plans-contaner">
            <div class="new-plan-btn-container">
                <button class="btn leader-request-btn">افزودن برنامه</button>
            </div>
            <div class="plan-card">
                <div class="plan-card-inner">
                    <div>
                        <div class="plan-title-container">
                            <h1>تیتر</h1>
                        </div>
                        <div class="plan-progress-container">
                            <p>وضعیت:</p>
                        </div>
                        <div class="approve-btn-container">
                            <button class="btn">تایید</button>
                        </div>
                        <div class="del-btn-container">
                            <button class="btn">حذف</button>
                        </div>
                    </div>
                    <div class="body-container">
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                        <p>date</p>
                    </div>
                </div>
                <div>
                    <div class="comments-container">
                        <div>
                            <p class="comment-txt-container">roozbeh: پیام</p>
                        </div>
                        <div>
                            <p class="comment-txt-container">roozbeh: پیام</p>
                        </div>
                        <div class="comment-input-container">
                            <textarea class="comment-input" placeholder="پیامی بنویسید..."></textarea>
                            <i class="fa-solid fa-share fa-2xl share-icon"></i>
                        </div>
                        
                    </div>
                    <div class="comments-btn-container">
                        <p>کامنت ها</p>
                        <p><i class="fa-solid fa-arrow-down"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
