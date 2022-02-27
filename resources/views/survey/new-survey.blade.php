@extends('../layout/' . $layout)

@section('subhead')
    <title>سامانه نظرسنجی | ایجاد پرسشنامه</title>
@endsection

@section('subcontent')
    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">ایجاد پرسشنامه</h2>
    </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-5 sm:py-5 mt-5">
        <div class="px-5 sm:px-20 mt-0">
            <div class="font-medium text-base">توضیحات و مقررات</div>
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-12">
                    <div id="faq-accordion-1" class="accordion p-5">
                        <div class="accordion-item">
                            <div id="faq-accordion-content-1" class="accordion-header">
                                <button class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-1" aria-expanded="true" aria-controls="faq-accordion-collapse-1">
                                    امکانات و توضیحات
                                </button>
                            </div>
                            <div id="faq-accordion-collapse-1" class="accordion-collapse collapse show" aria-labelledby="faq-accordion-content-1" data-tw-parent="#faq-accordion-1">
                                <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                    سامانه نظرسنجی به شما امکان ایجاد انواع پرسشنامه در قالب های مختلف را خواهد داد که شما میتوانید مشخص کنید چه نوع سوالی میخواهید مطرح کنید و چه کسانی میتوانند به سوالات شما پاسخ دهند.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div id="faq-accordion-content-2" class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-2" aria-expanded="false" aria-controls="faq-accordion-collapse-2">
                                    قوانین و مقررارت
                                </button>
                            </div>
                            <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-tw-parent="#faq-accordion-1">
                                <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                مطرح کردن سوالات سیاسی و به طور کلی سوالات هنجار شکن به صورت کلی ممنوع بوده و در صورت مشاهده نظرسنجی لغو و ممکن است ایجاد کننده نظرسنجی خارج از دسترس قرار گیرد.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <form name="myform" novalidate  method="post" action="{{url('new-survey')}}" enctype="multipart/form-data">
                @csrf
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="font-medium text-base">اطلاعات پرسشنامه</div>
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-1" class="form-label">* عنوان پرسشنامه</label>
                    <input id="input-wizard-1" type="text" class="form-control" name="title" placeholder="عنوان" required  :value="{{ old('title') }}">
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label">تصویر</label>
                    <input id="input-wizard-2" type="file" class="form-control" name="pic">
                </div>
                <div class="intro-y col-span-12 sm:col-span-12">
                    <label for="input-wizard-3" class="form-label">* توضیحات پرسشنامه</label>
                    <textarea class="form-control editor" name="desc" placeholder="توضیحات پرسشنامه" minlength="10">{{ old('desc') }}</textarea>
                </div>
                <div class="intro-y col-span-12 sm:col-span-3">
                    <label for="input-wizard-4" class="form-label">* در دسترس باشد؟</label>
                    <div class="form-switch mt-2">
                        <input type="checkbox" class="form-check-input" name="active">
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-3">
                    <label for="input-wizard-4" class="form-label">* عمومی باشد؟</label>
                    <div class="form-switch mt-2">
                        <input type="checkbox" class="form-check-input" name="public">
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-3">
                    <label for="input-wizard-4" class="form-label">* فقط کاربران ثبت نام شده؟</label>
                    <div class="form-switch mt-2">
                        <input type="checkbox" class="form-check-input" name="registered">
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-3">
                    <label for="input-wizard-4" class="form-label">* نوع پرسشنامه</label>
                    <select id="input-wizard-6" class="form-select" name="type">
                        <option value=0>معمولی چند سوالی</option>
                        <option value=1>امتحان</option>
                        <option value=2>معمولی تک سوالی</option>
                    </select>
                </div>
                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                    <button type="submit" class="btn btn-primary w-24">ایجاد</button>
                </div>
            </div>
        </div>
                </form>
    </div>
    <!-- END: Wizard Layout -->
@endsection

@section('script')
    <script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection