@extends('frontend.master')
@section('content')

<!-- cdn -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<!-- CSS -->
<link href="{{ mix('css/frontend/faq.css') }}" rel="stylesheet">
<!-- js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


<section class="faq-section" >
    <div class="container" data-aos="fade-up" data-aos-duration="700">
        <div class="row">
            <!-- ***** FAQ Start ***** -->
            <div class="col-md-12">
                <div class="faq-title text-center">
                    <h2 class="center" data-aos="fade-up"><span class="redtxt">FunRobo</span><span  class="greentxt">&nbsp;FAQ</span></h2>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="faq" id="accordion">
                    @php $i=1 @endphp 
                    @foreach($faq as $data)
                    <div class="card">
                        <div class="card-header" id="faqHeading-{{ $i }}">
                            <div class="mb-0">
                                <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-{{ $i }}"
                                    data-aria-expanded="true" data-aria-controls="faqCollapse-{{ $i }}">
                                    <span class="badge">{{ $i }}</span>{!! strip_tags($data->question) !!}
                                </h5>
                            </div>
                        </div>
                        <div id="faqCollapse-{{ $i }}" class="collapse" aria-labelledby="faqHeading-{{ $i }}"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p>{!! strip_tags($data->answer) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    @php $i++ @endphp 
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>