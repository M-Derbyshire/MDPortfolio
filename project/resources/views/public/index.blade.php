@extends('layouts.public')


@php
    //The subject's name and profession are called multiple times:
    //once in the page title, once in the metatags and then again 
    //in the header. So set the right values here, and use these.
    
    $subjectName = ($subject->name ?? '- Subject name not set -');
    $subjectProfession = ($subject->profession ?? '- Subject profession not set -');
@endphp


@section('title', $subjectName.' - '.$subjectProfession)
@section('secondaryStyleSheet', asset('css/indexStyle.css'))

@section('metaDescription', $subjectName. ' - '.$subjectProfession.' Portfolio')

@section('socialMediaMeta')
    <meta property="og:title" content="{{ $subjectName.' - '.$subjectProfession.' Portfolio' }}">
    <meta property="og:description" content="{{ $subjectProfession.' Portfolio of '.$subjectName.'.' }}">
@endsection

@section('content')
    
    <script src="{{ asset('/js/collapseButtonToggle.js') }}"></script>
    
    <!-- Headings section -->
    <header>
        <div class="row">
            <h1 class="ml-sm-0 mx-auto">{{ $subjectName }}</h1>
        </div>
        <div class="row">
            <h3 class="ml-sm-0 mx-auto">{{ $subjectProfession }}</h3>
        </div>
        
        <hr />
    </header>
    
    
    
    
    <!-- Why statement section (The Why) -->
    {{-- These values are properly sanitised in the controller, but allow <em> and <strong> --}}
    <div id="whyStatement" class="container-flex">
        <div class="row justify-content-sm-start justify-content-center">
            <p>{!! $subject->why_top ?? '- Subject top why line not set -' !!}</p>
        </div>
        
        <hr />
        
        <div class="row justify-content-sm-end justify-content-center">
            <p>{!! $subject->why_bottom ?? '- Subject bottom why line not set -' !!}</p>
        </div>
    </div>
    
    
    
    
    <!-- My Tools section (The How) -->
    <div id="toolsContainer" class="container sectionBox">
        <div class="row sectionHeading">
            <div class="col-12">
                <h2 class="text-center">My Tools</h2>
            </div>
        </div>
        
        <div id="toolsSectionGrid" class="collapse" aria-expanded="false">
            <div class="row sectionItemGrid mx-auto">
                @if(!isset($tools) || count($tools) == 0)
                    <p class="noSectionItemsMsg">No Tools to display</p>
                @else
                    @foreach($tools as $tool)
                        <div class="col-6 col-sm-3 sectionItem">
                            <figure class="figure">
                                <img 
                                    class="img-fluid figure-img" 
                                    src="{{ url('/uploads/logos/'.$tool->logo->url) }}" 
                                    alt="Logo for {{ $tool->name }}" 
                                />
                                <figcaption class="text-center">{{ $tool->name }}</figcaption>
                            </figure>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        
        @if(!isset($tools) || count($tools) > 4)
            <div class="row">
                <a 
                    class="collapsed sectionExpandBtn" 
                    href="#toolsSectionGrid" 
                    data-toggle="collapse" 
                    aria-expanded="false" 
                    aria-controls="toolsSectionGrid" 
                    onClick="toggleExpandButton(this, 'toolsSectionGrid')" 
                >
                    <div class="col-6 offset-3 col-sm-2 offset-sm-5" id="">
                        <img src="{{ url('/images/expandDropArrow.png') }}" class="img-fluid" />
                    </div>
                </a>
            </div>
        @endif
    </div>
    
    
    <!-- My Work section (The What) -->
    <div id="workContainer" class="container sectionBox">
        <div class="row sectionHeading">
            <div class="col-12">
                <h2 class="text-center">My Work</h2>
            </div>
        </div>
        
        <div id="workSectionGrid">
            @if(!isset($projects) || count($projects) == 0)
                <p class="noSectionItemsMsg">No Projects to display</p>
            @else
                @for($i = 0; $i < count($projects); $i++)
                    <div class="row sectionItem {{ ($i == count($projects) - 1) ? 'lastItem' : '' }}">
                        <div class="col-6 offset-3 col-sm-3 offset-sm-0">
                            <img src="{{ url('/uploads/logos/'.$projects[$i]->logo->url) }}" class="img-fluid" />
                        </div>
                        <div class="text-center col-6 offset-3 text-sm-left col-sm-9 offset-sm-0 projectItemDetails">
                            <h5 class="my-3 mb-sm-2 mt-sm-0">{{ $projects[$i]->title }}</h5>
                            <p class="d-none d-sm-block">{!! $projects[$i]->smallDescription !!}</p> {{-- The smallDescription is sanitized in
                                                                            the controller --}}
                            <a href="/projects/{{ $projects[$i]->id }}" class="btn btn-secondary btn-sm">Read More</a>
                        </div>
                    </div>
                    @if($i < count($projects) - 1)
                        <hr />
                    @endif
                @endfor
            @endif
        </div>
        
        <div class="row">
            <a class="sectionExpandBtn" href="/projects">
                See all Projects
            </a>
        </div>
    </div>
    
    
    <!-- More About Me section -->
    <div id="aboutLinksContainer" class="container sectionBox">
        <div class="row sectionHeading">
            <div class="col-12">
                <h2 class="text-center">More About Me</h2>
            </div>
        </div>
        
        <div id="aboutLinksSectionGrid">
            @if((!isset($aboutLinks) || count($aboutLinks) == 0) && !isset($cv) && !isset($githubLink) && !isset($subject->email) && !isset($subject->phone))
                <p class="noSectionItemsMsg">No Links to display</p>
            @else
                
                <!-- The one/two links that show above the others, with captions (C.V and GitHub) -->
                {{-- If only one link, then we want it centered --}}
                <div 
                    class="row {{ (!isset($cv) || !isset($githubLink)) ? 'justify-content-sm-center' : '' }}" 
                    id="priorityAboutLinks"
                >
                    @if(isset($cv))
                        <div class="col-10 offset-1 col-sm-3 offset-sm-2 text-center sectionItem">
                            <a href="{{ url('/uploads/cvs/'.$cv->url) }}" target="_blank">
                                <figure class="figure">
                                    <img 
                                        class="img-fluid figure-img" 
                                        src="{{ url('/uploads/logos/'.$cv->logo->url) }}" 
                                        alt="Logo for C.V" 
                                    />
                                    <figcaption>
                                        <div class="thinUnderlineHover">
                                            My C.V
                                        </div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    @endif
                    
                    @if(isset($githubLink))
                        <div class="col-10 offset-1 col-sm-3 offset-sm-2 text-center sectionItem">
                            <a href="{{ $githubLink->url }}" target="_blank">
                                <figure class="figure">
                                    <img 
                                        class="img-fluid figure-img" 
                                        src="{{ url('/uploads/logos/'.$githubLink->logo->url) }}" 
                                        alt="Logo for my Github profile" 
                                    />
                                    <figcaption>
                                        <div class="thinUnderlineHover">
                                            My GitHub
                                        </div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    @endif
                </div>
                
                <!-- The rest of the links, only displayed by their logos -->
                @if(isset($aboutLinks) && count($aboutLinks) > 0)
                    <div class="row" id="mainAboutLinks">
                        <div class="col-8 offset-2" id="mainAboutLinksPositionCol">
                            <div class="container" id="mainAboutLinksContainer">
                                {{-- If there are less than 4 (so the row is incomplete), then center,
                                    but only on sm or greater. On smaller screens, only center an 
                                    incomplete row if there's only 1 link, as the row would be 2 items long --}}
                                <div class="row {{ (count($aboutLinks) < 4) ? 'justify-content-sm-center' : ''}} 
                                            {{ (count($aboutLinks) == 1) ? 'justify-content-center' : '' }}">
                                    @if(isset($aboutLinks))
                                        @foreach($aboutLinks as $aboutLink)
                                            <div class="col-6 col-sm-3 sectionItem">
                                                <a href="{{ $aboutLink->url }}" target="_blank">
                                                    <img 
                                                        class="img-fluid" 
                                                        src="{{ url('/uploads/logos/'.$aboutLink->logo->url) }}" 
                                                        alt="{{ $aboutLink->text }}" 
                                                    />
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Email address and phone number -->
                <div id="contactDetails">
                    @if(isset($subject->email))
                        <div class="row contactDetailsRow" id="contactEmailRow">
                            <div class="col-4 col-sm-2 offset-1 contactDetailTitle">
                                Email:
                            </div>
                            <div class="col-10 col-sm-8 offset-1 offset-sm-0 contactDetailInfo">
                                <a href="mailto:mderbyshiredeveloper@gmail.com">{{ $subject->email }}</a>
                            </div>
                        </div>
                    @endif
                    
                    @if(isset($subject->phone))
                        <div class="row contactDetailsRow" id="contactPhoneRow">
                            <div class="col-4 col-sm-2 offset-1 contactDetailTitle">
                                Phone:
                            </div>
                            <div class="col-10 col-sm-8 offset-1 offset-sm-0 contactDetailInfo">
                                {{ $subject->phone }}
                            </div>
                        </div>
                    @endif
                </div>
                
            @endif
        </div>
    </div>
    
@endsection