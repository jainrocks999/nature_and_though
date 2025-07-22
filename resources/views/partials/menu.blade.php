	<div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">

              <ul class="nav">
                    <li class="nav-item active">
                        <a href="{{ route('dashboard')}}">
                            <i class="la la-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
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
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('surveyResults.getSurveyResults')}}">Survey Results </a>
                                </li>   
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="manage-survey.html">Post-Purchase Survey </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="manage-survey.html">Post Survey Schedule</a>
                                </li> -->
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
                                    <a class="nav-link" href="{{ route('typeform.getTypeFormResponse')}}">TypeForm Response List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="create-survey.html">Pre-Survey Response</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="manage-survey.html">Post-Survey Response</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>