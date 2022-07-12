@extends('layouts.user')

@section('content')
<div class="announcement-container">
    @foreach ($announcement as $data)
        <div class="announcement">
            <div class="date-announcement">
                <p>{{$data->title}}</p>
                <p>{{date_format($data->created_at,"m/d/Y H:i A")}}</p>
            </div>
            
            <div class="content-announcement">
                <p>{{$data->content}}</p>
            </div>
                @foreach($imageId as $data1)
                    @if($data1->announcement_id == $data->id)
                    <div class="images-announcement">
                        <div id="announcementImages-{{$data->id}}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @php
                                $counter = 0;
                                @endphp
                                @foreach($announcementImages as $image)
                                    @if($data1->announcement_id == $image->announcement_id)
                                        @if($counter == 0)
                                            <button type="button" data-bs-target="#announcementImages-{{$data->id}}" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        @else
                                            <button type="button" data-bs-target="#announcementImages-{{$data->id}}" data-bs-slide-to="{{$counter}}" aria-label="Slide {{$counter}}"></button>
                                        @endif
                                        @php
                                            $counter++;
                                        @endphp
                                    @endif
                                @endforeach
                              </div>
                            <div class="carousel-inner">
                                @php
                                $counter1 = 0;
                                @endphp
                                @foreach($announcementImages as $image)
                                    @if($data1->announcement_id == $image->announcement_id)
                                        @if($counter1 == 0)
                                            <div class="carousel-item active" data-bs-interval="5000">
                                                <img src="/AnnouncementImages/{{$image->image}}" class="d-block w-100" alt="">
                                            </div>
                                        @else
                                            <div class="carousel-item" data-bs-interval="5000">
                                                <img src="/AnnouncementImages/{{$image->image}}" class="d-block w-100" alt="">
                                            </div>
                                        @endif
                                        @php
                                            $counter1++;
                                        @endphp
                                    @endif
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#announcementImages-{{$data->id}}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next" type="button" data-bs-target="#announcementImages-{{$data->id}}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                          </div>
                    </div>
                    @endif
                @endforeach
        </div>
    @endforeach
</div>
@endsection