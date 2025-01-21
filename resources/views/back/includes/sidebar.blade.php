<style>
.vertical-menu::-webkit-scrollbar {
    display: none;
}
</style>
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu" style="overflow-y: scroll;">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('back/assets/images/logo.svg') }}" width="80" alt="">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ auth()->guard('admin')->user()->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                    Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-3-line"></i>
                        <span>Tənzimləmələr</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       
                    <li>
                            <a href="{{ route('back.pages.translation-manage.index') }}">
                                <i class="mdi mdi-translate"></i>
                                <span>Tərcümələr</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('back.pages.logos.index') }}">
                                <i class="mdi mdi-image"></i>
                                <span>Logolar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('back.pages.seo.index') }}">
                                <i class="ri-search-line"></i>
                                <span>SEO</span>
                            </a>
                        </li>
                       
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-home-line"></i>
                        <span>Ana Səhifə</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       
                    <li>
                            <a href="{{ route('back.pages.home-cards.index') }}">
                                <i class="mdi mdi-home"></i>
                                <span>Hero</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('back.pages.about.index') }}">
                                <i class="mdi mdi-home"></i>
                                <span>About</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('back.pages.comments.index') }}">
                                <i class="mdi mdi-comment"></i>
                                <span>Comments</span>
                            </a>
                        </li>
                        

                         
                       
                    </ul>


                    <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-information-line"></i>
                        <span>Biz kimik?</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       
                    <li>
                            <a href="{{ route('back.pages.leaders.index') }}">
                                <i class="ri-user-line"></i>
                                <span>Komandamız</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('back.pages.about-hero.index') }}">
                                <i class="ri-information-line"></i>
                                <span>About Hero</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('back.pages.about-section.index') }}">
                                <i class="ri-information-line"></i>
                                <span>About Section</span>
                            </a>
                        </li>
                      
                        

                         
                       
                    </ul>


                    <li>
                            <a href="{{ route('back.pages.service.index') }}">
                                <i class="ri-service-line"></i>
                                <span>Xidmətlər</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('back.pages.keyfiyet.index') }}">
                                <i class="ri-star-line"></i>
                                <span>Keyfiyet</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('back.pages.portfolio_type.index') }}">
                                <i class="ri-brackets-line"></i>
                                <span>Portfolio Tipi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('back.pages.portfolio.index') }}">
                                <i class="ri-profile-line"></i>
                                <span>Portfolio</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('back.pages.gallery_type.index') }}">
                                <i class="ri-brackets-line"></i>
                                <span>Galeriya Tipi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('back.pages.galleries.index') }}">
                                <i class="ri-image-line"></i>
                                <span>Galeriya</span>
                            </a>
                        </li>
                     
                        <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-briefcase-line"></i>
                        <span>Karyera</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       
                   
                    <li>
                            <a href="{{ route('back.pages.career_hero.index') }}">
                                <i class="ri-briefcase-line"></i>
                                <span>Career Hero</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('back.pages.acceptance.index') }}">
                                <i class="ri-check-line"></i>
                                <span>İşə Qəbul Prosesi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('back.pages.vacation_hero.index') }}">
                                <i class="ri-calendar-line"></i>
                                <span>Vacation Hero</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('back.pages.vacation.index') }}">
                                <i class="ri-briefcase-line"></i>
                                <span>Vakansiyalar</span>
                            </a>
                        </li>

                         
                       
                    </ul>

                    <li>
                        <a href="{{ route('back.pages.blog_type.index') }}">
                            <i class="ri-book-line"></i>
                            <span>Blog Tipi</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('back.pages.blog.index') }}">
                            <i class="ri-book-line"></i>
                            <span>Blog</span>
                        </a>
                    </li>



                    <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-phone-line"></i>
                        <span>Əlaqə</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       
                   
                    <li>
                        <a href="{{ route('back.pages.contact.index') }}">
                            <i class="ri-phone-line"></i>
                            <span>Əlaqə Məlumatları</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('back.pages.contact_requests.index') }}">
                            <i class="ri-phone-line"></i>
                            <span>Əlaqə Müraciətləri</span>
                        </a>
                    </li>

                         
                       
                    </ul>
                    <li>
                        <a href="{{ route('back.pages.social.index') }}">
                            <i class="ri-share-line"></i>
                            <span>Sosial Media</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('back.pages.socialshare.index') }}">
                            <i class="ri-share-line"></i>
                            <span>Sosial Share</span>
                        </a>
                    </li>


                    
                  

                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
