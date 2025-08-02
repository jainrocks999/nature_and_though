	<div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">

              <ul class="nav">
                    <li class="nav-item active">
                        <a href="{{ route('dashboard')}}">
                            <i class="la la-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                     <li class="nav-item active">
                        <a href="{{ route('surveyConfig.getSurveyConfig')}}">
                            <i class="la la-gear"></i>
                            <p>Survey Configuration</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="{{ route('typeform.getTypeFormData')}}">
                            <i class="la la-refresh"></i>
                            <p>Typeform Synchronization</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="{{ route('product.getProductList')}}">
                            <i class="la la-refresh"></i>
                            <p>Product Synchronization</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="{{ route('surveyResults.getSurveyResults')}}">
                            <i class="la la-connectdevelop"></i>
                            <p>View Survey Insights</p>
                        </a>
                    </li>
                     <li class="nav-item active">
                        <a href="{{ route('surveyResults.getUserSurveyResults')}}">
                            <i class="la la-th-list"></i>
                            <p>View User Journey</p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#submenuSurvey" data-toggle="collapse" aria-expanded="false" class="nav-link collapsed">
                            <i class="la la-gear"></i>
                            <p>Configure Survey </p>
                             <i class="la la-angle-down"></i>
                        </a>
                        <div class="collapse" id="submenuSurvey">
                            <ul class="nav flex-column ml-3">
                                <li class="nav-item">
                                        <a class="nav-link" href="{{ route('surveyConfig.getSurveyConfig')}}">Survey Configuration List </a>
                                </li>  
                                 <li class="nav-item">
                                        <a class="nav-link" href="{{ route('typeform.getTypeFormData')}}">Typeform List </a>
                                </li>    
                                <li class="nav-item">
                                        <a class="nav-link" href="{{ route('product.getProductList')}}">Product List </a>
                                </li>      
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#submenuSurveyResponse" data-toggle="collapse" aria-expanded="false" class="nav-link collapsed">
                           <i class="la la-gg-circle"></i>   
                            <p>Survey Insights & User Tracking</p>
                            <i class="la la-angle-down"></i>
                        </a>
                        <div class="collapse" id="submenuSurveyResponse">
                            <ul class="nav flex-column ml-3"> 
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('surveyResults.getSurveyResults')}}">All Survey Results </a>
                                </li>  
                                 <li class="nav-item">
                                    <a class="nav-link" href="{{ route('surveyResults.getUserSurveyResults')}}">User Survey Results </a>
                                </li>    
                            </ul>
                        </div>
                    </li> -->
                </ul>
            </div>
        </div>