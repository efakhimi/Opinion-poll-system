@extends('../layout/' . $layout)

@section('subhead')
    <title>لیست پرسشنامه ها</title>
@endsection

@section('subcontent')

    <h2 class="intro-y text-lg font-medium mt-10">لیست پرسشنامه ها</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if(session('statusErr'))
            <div class="alert alert-danger">
                {{ session('statusErr') }}
            </div>
        @endif
        </div>
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button class="btn btn-primary shadow-md mr-2" onclick="window.location.href='{{ route('new-user.index') }}';">افزودن کاربر جدید</button>
            <!-- <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-feather="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div> -->
            <div class="hidden md:block mx-auto text-slate-500">نمایش {{ ( (($surveys->currentPage()-1)*$surveys->perPage())+1 ) }} تا  {{ ( (($surveys->currentPage()-1)*$surveys->perPage())+$surveys->count() ) }} از مجموع  {{ ( $surveys->total() ) }} کاربر</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <!-- <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i> -->
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">تصویر</th>
                        <th class="whitespace-nowrap">نام</th>
                        <th class="text-center whitespace-nowrap">تعداد سوالات</th>
                        <th class="text-center whitespace-nowrap">وضعیت</th>
                        <th class="text-center whitespace-nowrap">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surveys as $survey)
                        
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="{{ ($survey['photo'] == '' ? url('media/no-image-survey.png') : url('images/survey/'  . $survey['photo'])) }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="" class="font-medium whitespace-nowrap">{{ $survey['title'] }}</a>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ ($survey['public'] == 0 ? "خصوصی" : "عمومی") }}</div>
                            </td>
                            <td class="text-center">{{ $sCount[$survey['id']] }} سوال</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center {{ $survey['active'] ? 'text-success' : 'text-danger' }}">
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $survey['active'] ? 'فعال' : 'غیر فعال' }}
                                </div>
                            </td>
                            <td class="table-report__action w-90">
                                <div class="flex justify-center items-center">
                                    @if($sCount[$survey['id']] == 0)
                                        <a class="flex items-center mr-3" href="{{url('finilize-survey/'.$survey['id'])}}">
                                            <i data-feather="file-plus" class="w-4 h-4 mr-1"></i> افزودن سوالات
                                        </a>
                                    @else
                                        <!-- <a class="flex items-center mr-3" href="{{url('edit-survey-questions/'.$survey['id'])}}">
                                            <i data-feather="edit-3" class="w-4 h-4 mr-1"></i> ویرایش سوالات
                                        </a> -->
                                    @endif
                                    <a class="flex items-center mr-3" href="{{url('edit-survey/'.$survey['id'])}}">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i> ویرایش
                                    </a>
                                    <a class="flex items-center mr-3" href="{{url('survey-detail/'.$survey['id'])}}">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i> جزئیات
                                    </a>
                                    <a class="flex items-center text-danger" href="{{url('del-survey/'.$survey['id'])}}" >
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> حذف
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <!-- {{ $surveys->links() }} -->
        @if ($surveys->hasPages())
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    @if (!$surveys->onFirstPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ ($surveys->url(1)) }}">
                            <i class="w-4 h-4" data-feather="chevrons-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="{{ ($surveys->previousPageUrl()) }}">
                            <i class="w-4 h-4" data-feather="chevron-right"></i>
                        </a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="{{ ($surveys->url($surveys->currentPage() - 1)) }}">{{ ($surveys->currentPage() - 1) }}</a>
                    </li>
                    @endif
                    <li class="page-item active">
                        <a class="page-link" href="{{ ($surveys->url($surveys->currentPage())) }}">{{ ($surveys->currentPage()) }}</a>
                    </li>
                    @if ($surveys->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ ($surveys->url($surveys->currentPage() + 1)) }}">{{ ($surveys->currentPage() + 1) }}</a>
                    </li>
                    
                    <li class="page-item">
                        <a class="page-link" href="{{ ($surveys->nextPageUrl()) }}">
                            <i class="w-4 h-4" data-feather="chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="{{ ($surveys->url($surveys->lastPage())) }}">
                            <i class="w-4 h-4" data-feather="chevrons-left"></i>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif
        <!-- END: Pagination -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-feather="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">آیا مطمئن هستید؟</div>
                        <div class="text-slate-500 mt-2">آیا واقعا میخواهید کاربر را حذف کنید؟ <br>این کار برگشت ناپذیر است.</div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">لغو</button>
                        <button type="button" class="btn btn-danger w-24" id="delConfirmation">حذف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
        
            
            
@endsection

@section('script')
    <script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection
