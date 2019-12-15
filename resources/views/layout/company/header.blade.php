<div class="container-fluid">
    <div class="row dashboard-header align-middle text-center">
        <div class="col-12 col-sm col-md-3">
            <a href="{{route('dashboard')}}" style="text-decoration: none;"><h3 class="shoza-shop-logo" style="font-weight: bold;color: #1a4993;">
                    <i>SOZASHOP.COM</i></h3></a>
        </div>



        <div class="col-12 col-sm col-md-5 header-margin star-stuff-search-start">
            <div class="dashboard-search star-stuff-search">
                <form action="{{route('header-search')}}" method="post">
                    @csrf
                   
                        <div class="star-stuff-search-main">
                            <input id="star-stuff-input-id" type="text" name="search" placeholder="Search Only Invoice Number">
                     <i class="fas fa-search star-stuff-search-icon"></i>
                        </div>
                </form>
            </div>
        </div>




        <div class="col-12 col-sm col-md-4 header-margin star-stuff-right-top-section">
            <div class="dashboard-user">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php if($logo->logo){; ?>
                                <img src="{{asset('public/shop_logo/'.$logo->logo)}}" height="44px;" width="44px;"/>
                        <?php }else{; ?>
                        <img src="{{asset('public/shop_logo/default.png')}}" height="44px;" width="44px;"/>
                      <?php }; ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item mb-2" style="background-color: #1f6fb2;color: white;"> {{ Session::get('loggedUser')['fname']}} {{ Session::get('loggedUser')['lname']}} </a>
                        <a href="{{route('profile')}}" class="dropdown-item"> Profile</a>
                        <a href="{{route('support')}}" class="dropdown-item">Support</a>
                        <a href="{{route('admin-message')}}" class="dropdown-item">Message</a>
                        <a href="{{route('cng_pass')}}" class="dropdown-item" style="background-color: inherit;">Change Password</a>
                        <a href="{{route('logout')}}" class="dropdown-item" style="background-color: inherit;">Signout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




        <div class="col-12 col-sm col-md-2 header-margin star-stuff-toggle">
            <div class="menu-icon star-stuff-menuIcon"> <i class="fas fa-align-justify"></i></div>
            <div class="expand-icon star-stuff-expand">
                <a href="#" onclick="openFullscreen();" class="open-full-screen"><i class="fas fa-expand-arrows-alt"></i></a>

                <a href="#" onclick="closeFullscreen();" class="close-full-screen"><i class="fas fa-expand-arrows-alt"></i></a>
            </div>
        </div>


