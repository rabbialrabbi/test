<div class="footer-area" style="background: #517cff;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-left-social">
                    <label for="">Get In Touch</label><br>
                    <a href="{{'https://'.$social1->title}}" target="_blank"><i class="fab fa-facebook-f home-page-social"></i></a>
                    <a href="{{'https://'.$social3->title}}" target="_blank"><i class="fab fa-twitter home-page-social"></i></a>
                    <a href="{{'https://'.$social2->title}}" target="_blank"><i class="fab fa-youtube home-page-social"></i></a>
                    <a href="{{'https://'.$social4->title}}" target="_blank"><i class="fab fa-linkedin-in home-page-social"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-right-subscribe">
                    <label for="">Subscribe</label> <br>
                    <input type="text">
                    <input type="submit" value="submit">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-area-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright-terms">
                   {{$footer->title}} /
                    <!-- Button trigger modal -->
                    <a href="" data-toggle="modal" data-target="#exampleModalLong" style="text-decoration: none !important;">Terms & Condition</a> /
                    <a href="{{route('about')}}" style="text-decoration: none !important;">About Us</a> /
                    <a href="{{route('blog')}}" style="text-decoration: none !important;">Blog</a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{$terms->title}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>{!! html_entity_decode($terms->description)!!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
