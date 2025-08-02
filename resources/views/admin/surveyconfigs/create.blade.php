@extends('layouts.admin')

@php
    $shownTypes = [];
@endphp
@section('content') 
<div class="content">
	<div class="container-fluid">
        <div class="row mb-4">
            <div class="col-lg-12">
                <a href="{{route('surveyConfig.getSurveyConfig')}}">
                    <button type="button" class="btn btn-default">{{ trans('global.back_to_list') }}</button>
                </a>
            </div>
        </div>
        <div class="row">
            @if ($errors->any())
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        <strong>There were some problems with your input:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Survey Configuration</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('surveyConfig.storeSurveyConfig') }}" method="POST">
                    @csrf
                    <!-- <div class="row mb-3">
                         <div class="col-lg-12">
                            <label class="form-label"><h6>Survey Config</h6></label>
                        </div>  
                        <div class="col-lg-12" id="subinpt">
                            <label for="user_type" class="form-label">User Type</label>
                            <select name="user_type" id="user_type" class="form-control">
                                <option value="">Select User Type</option>
                                <option value="pre_purchase">Pre-Purchase</option>
                                <option value="post_purchase">Post-Purchase</option>
                            </select>
                            @error('user_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div> -->
                      <div class="row">
                        <div class="col-lg-12" id="subinpt">
                            <label class="form-label d-block">Choose Survey Type <span class="required-star">*</span></label>
                            <div class="form-check form-check-inline pb-0">
                                <input class="form-check-input" type="radio" name="survey_type" id="pre_purchase_id" value="pre_purchase" {{ old('survey_type') == 'pre_purchase' ? 'checked' : '' }}>
                                <label class="form-check-label form-radio-sign" for="pre_purchase_id">Pre-Purchase</label>
                            </div>
                            <div class="form-check form-check-inline pb-0">
                                <input class="form-check-input" type="radio" name="survey_type" id="post_purchase_id" value="post_purchase" {{ old('survey_type') == 'post_purchase' ? 'checked' : '' }}>
                                <label class="form-check-label form-radio-sign" for="post_purchase_id">Post-Purchase</label>
                            </div>
                            @error('survey_type')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12" id="subinpt">
                            <label for="type_form_id" class="form-label">TypeForm <span class="required-star">*</span></label>
                            <select name="type_form_id" id="type_form_id" class="form-control">
                                <option value="">Select TypeForm</option>
                                @if(isset($data['typeForms']) && !empty($data['typeForms']))
                                    @foreach($data['typeForms'] as $val)
                                        <option value="{{ $val->type_form_id }}"
                                            {{ (old('type_form_id') ?? ($existingData->type_form_id ?? '')) == $val->type_form_id ? 'selected' : '' }}>
                                            {{ $val->title }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('type_form_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <label class="form-label"><h6>Push Notification & Email Config</h6></label>
                        </div>  
                        <div class="col-lg-12" id="subinpt">
                            <label class="form-label d-block">Choose Survey Push Notification & Email <span class="required-star">*</span></label>
                             <div class="form-check form-check-inline pb-0">
                                <input class="form-check-input" type="radio" name="survey_notification_status" id="notification_disable_id" value="one_time" {{ old('survey_notification_status') == 'one_time' ? 'checked' : '' }}>
                                <label class="form-check-label form-radio-sign" for="notification_disable_id">One Time</label>
                            </div>
                            <div class="form-check form-check-inline pb-0">
                                <input class="form-check-input" type="radio" name="survey_notification_status" id="notification_enable_id" value="multiple"  {{ old('survey_notification_status') == 'multiple' ? 'checked' : '' }}>
                                <label class="form-check-label form-radio-sign" for="notification_enable_id">Recurring</label>
                            </div>
                            @error('survey_notification_status')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3" id="nft" style="display:none;">
                        <div class="col-lg-6" id="subinpt">
                            <label for="notification_freq" class="form-label">Push Notification & Email Frequency <span class="required-star">*</span></label>
                            <select name="notification_freq" id="notification_freq" class="form-control">
                                <option value="">Select email notification frequency </option>
                                <option value="two_day_a_week" {{ old('notification_freq') == 'twice_a_week' ? 'selected' : '' }}>Twice a Week</option>
                                <option value="one_day_a_weekly" {{ old('notification_freq') == 'once_a_week' ? 'selected' : '' }}>Once a Week</option>
                                <option value="half_month" {{ old('notification_freq') == 'in_two_week' ? 'selected' : '' }}>In 2 Week</option>
                                <option value="monthly" {{ old('notification_freq') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <!-- <option value="custom" {{ old('notification_freq') == 'custom' ? 'selected' : '' }}>Custom Days</option> -->
                            </select>
                            @error('notification_freq')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                            <div class="col-lg-6" id="custom_days_wrapper" style="display: none;">
                                <label for="custom_days" class="form-label">Custom Days</label>
                                <input type="number" min="1" name="custom_days" id="custom_days" class="form-control"
                                    value="{{ old('custom_days') }}">
                                @error('custom_days')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                    </div>
                
                    <template id="product-select-template">
                        <select name="product_id[]" class="form-control product-select" multiple>
                            @if(isset($data['products']) && !empty($data['products']))
                                @foreach($data['products'] as $val)
                                    <option value="{{ $val->shopify_product_id }}">{{ $val->product_title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </template>
                    <input type="hidden" name="selected_product_value" id="selected_product_value" >
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <label class="form-label"><h6>Product Suggestion</h6></label>
                        </div>
                    </div>
                    <div id="product_suggestion_wrapper">   
                        <div class="row product-suggestion-item">
                            <div class="col-lg-4" id="subinpt">
                                <label class="form-label">Selecte Products <span class="required-star">*</span></label>
                                <select name="product_id[]" class="form-control product-select" multiple>
                                    @if(isset($data['products']) && !empty($data['products']))
                                        @foreach($data['products'] as $val)
                                            <option value="{{ $val->shopify_product_id }}">{{ $val->product_title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('product_id')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-lg-3">
                                <label class="form-label">Min Score</label>
                                <input type="number" class="form-control" name="min_score[]" value="">
                                  @error('min_score')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-lg-3">
                                <label class="form-label">Max Score</label>
                                <input type="number" class="form-control" name="max_score[]" value="">
                                @error('max_score')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="col-lg-2">
                                 <label class="form-label"></label>
                                <button type="button" class="btn btn-danger remove-pr">Remove</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-success add-pr">Add</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <label for="discount" class="form-label"><h6>Apply Discount</h6></label>
                        </div>    
                        <div class="col-lg-3" id="subinpt">
                            <label class="form-label">Choose Discount Provide</label>
                            <select name="discount_status" class="form-control discount-toggle">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>

                        <div class="col-lg-3 discount-type-area d-none">
                            <label class="form-label">Discount Type</label>
                            <select name="discount_type" class="form-control discount-type-select">
                                <option value="">Select Type</option>
                                <option value="percentage">Percentage</option>
                                <option value="flat">Flat</option>
                            </select>
                        </div>

                        <div class="col-lg-3 discount-type-area d-none">
                            <label class="form-label">Discount User Type</label>
                            <select name="discount_user_type" class="form-control discount-type-select">
                                <option value="">Select Type</option>
                                <option value="all">All User</option>
                                <option value="single">Specific User</option>
                            </select>
                        </div>

                        <div class="col-lg-3 discount-fields d-none">
                            <label class="form-label">Discount Code</label>
                            <input type="text" name="discount_code" class="form-control discount-code">
                        </div>
                        <div class="col-lg-3 discount-fields d-none">
                            <label class="form-label">Value</label>
                            <input type="number" name="discount_value" class="form-control discount-value" min="0">
                        </div>
                    </div>
                    <div class="row mt-3">
                         <div class="col-lg-12">
                            <label for="rewords" class="form-label"><h6>Reward Point</h6></label>
                        </div>    
                         <div class="col-lg-6" id="subinpt">
                            <label for="participation_points" class="form-label">Reward Point for Survey Participation </label>
                            <input type="number" min="1" name="participation_points" id="participation_points" class="form-control"
                                value="{{ old('participation_points') }}">
                            @error('participation_points')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="reward_points" class="form-label">Reword Point for Survey Result</label>
                            <input type="number" min="1" name="reward_points" id="reward_points" class="form-control"
                                value="{{ old('reward_points') }}">
                            @error('reward_points')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-lg-6" id="subinpt">
                            <div class="form-check form-check-inline pb-0">
                                <label class="form-label d-block mr-3">Status</label>
                                <input class="form-check-input" type="checkbox" name="status" id="status_active_id" value="active" checked {{ old('status') == 'active' ? 'checked' : '' }}>
                                <label class="form-check-label form-check-sign" for="status_active_id">Active</label>
                            </div>
                            <!-- <div class="form-check form-check-inline pb-0">
                                <input class="form-check-input" type="radio" name="status" id="status_inactive_id" value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                <label class="form-check-label form-radio-sign" for="status_inactive_id">InActive</label>
                            </div> -->
                            @error('status')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('select[name="product_id[]"]').select2({
            placeholder: "Select Product"
        });
    });

      $(document).ready(function () {
        function toggleNotificationFields() {
            const isEnabled = $('#notification_enable_id').is(':checked');
            $('#nft').toggle(isEnabled);
        }

        function toggleCustomDays() {
            const freq = $('#notification_freq').val();
            $('#custom_days_wrapper').toggle(freq === 'custom');
        }

        // Trigger on page load (if old values are set)
        toggleNotificationFields();
        toggleCustomDays();

        // Bind change event for push notification
        $('input[name="survey_notification_status"]').change(function () {
            toggleNotificationFields();
        });

        // Bind change event for frequency dropdown
        $('#notification_freq').change(function () {
            toggleCustomDays();
        });
    });

    let productSelections = [];
  $(document).ready(function () {
    $('.product-select').select2();
  
    $(document).on('change', '.product-select', function () {
        updateSelections();
    });
   
    $(document).on('click', '.add-pr', function () {
        let wrapper = $('#product_suggestion_wrapper');
        let selectHTML = $('#product-select-template').html();
        let newItem = `
            <div class="row mt-3 product-suggestion-item">
                <div class="col-lg-4" id="subinpt">
                    <label class="form-label">Select Products</label>
                    ${selectHTML}
                </div>

                <div class="col-lg-3">
                    <label class="form-label">Min Score</label>
                    <input type="number" class="form-control" name="min_score[]" value="">
                </div>

                <div class="col-lg-3">
                    <label class="form-label">Max Score</label>
                    <input type="number" class="form-control" name="max_score[]" value="">
                </div>
                <div class="col-lg-2">
                    <label class="form-label"></label>
                    <button type="button" class="btn btn-danger remove-pr">Remove</button>
                </div>
            </div>
        `;
        wrapper.append(newItem);
        wrapper.find('.product-select').last().select2();
        updateSelections();
    });

    // Remove section but keep one
    $(document).on('click', '.remove-pr', function () {
        if ($('.product-suggestion-item').length > 1) {
            $(this).closest('.product-suggestion-item').remove();
            updateSelections();
        } else {
            alert("At least one section must remain.");
        }
    });

    // Store selected values in productSelections[]
    function updateSelections() {
            productSelections = [];
            $('.product-select').each(function () {
                let selected = $(this).val() || [];
                productSelections.push(selected);
            });
            $('#selected_product_value').val(JSON.stringify(productSelections));
        }
    });


    //dicount code 
     $(document).ready(function() {
        $('.discount-toggle').on('change', function() {
            const selected = $(this).val();
            const $row = $(this).closest('.row');
            if (selected === 'yes') {
                $row.find('.discount-type-area').removeClass('d-none');
            } else {
                $row.find('.discount-type-area, .discount-fields').addClass('d-none');
                $row.find('.discount-code').val('');
                $row.find('.discount-value').val('');
            }
        });

        $('.discount-type-select').on('change', function() {
            const $row = $(this).closest('.row');
            const discountCode = 'DSC-' + Math.random().toString(36).substr(2, 6).toUpperCase();
            if ($(this).val()) {
                $row.find('.discount-fields').removeClass('d-none');
                $row.find('.discount-code').val(discountCode);
            } else {
                $row.find('.discount-fields').addClass('d-none');
                $row.find('.discount-code').val('');
                $row.find('.discount-value').val('');
            }
        });
    });

    
    //Delay days
    document.addEventListener('DOMContentLoaded', function () {
        const delayType = document.getElementById('notification_freq');
        const customWrapper = document.getElementById('custom_days_wrapper');
        function toggleCustomDays() {
            if (delayType.value === 'custom') {
                customWrapper.style.display = 'block';
            } else {
                customWrapper.style.display = 'none';
            }
        }
        delayType.addEventListener('change', toggleCustomDays);
        toggleCustomDays();
    });

    //JS VALIDATION
     document.querySelector("form").addEventListener("submit", function (e) {
        let isValid = true;
        let messages = [];

        const userType = document.getElementById("user_type").value;
        const typeForm = document.getElementById("type_form_id").value;
        const typeFormType = document.getElementById("type_form_type").value;
        const surveyType = document.querySelector('input[name="survey_type"]:checked');
        const emailOption = document.querySelector('input[name="selected_email"]:checked');
        const notifOption = document.querySelector('input[name="survey_notification_status"]:checked');

        if (!userType) {
            isValid = false;
            messages.push("User Type is required.");
        }

        if (!typeForm) {
            isValid = false;
            messages.push("TypeForm is required.");
        }

        if (!typeFormType) {
            isValid = false;
            messages.push("TypeForm Type is required.");
        }

        if (!surveyType) {
            isValid = false;
            messages.push("Survey Type is required.");
        }

        if (!emailOption) {
            isValid = false;
            messages.push("Survey Email Option is required.");
        }

        if (!notifOption) {
            isValid = false;
            messages.push("Survey Notification Option is required.");
        }

        // Validate product suggestion fields
        document.querySelectorAll('.product-suggestion-item').forEach((section, index) => {
            const product = section.querySelector('select[name="product_id[]"]');
            const min = section.querySelector('input[name="min_score[]"]');
            const max = section.querySelector('input[name="max_score[]"]');

            if (!product.value) {
                isValid = false;
                messages.push(`Product is required in section ${index + 1}.`);
            }

            if (!min.value || isNaN(min.value)) {
                isValid = false;
                messages.push(`Score min must be a number in section ${index + 1}.`);
            }

            if (!max.value || isNaN(max.value)) {
                isValid = false;
                messages.push(`Score To must be a number in section ${index + 1}.`);
            }

            if (parseFloat(max.value) < parseFloat(min.value)) {
                isValid = false;
                messages.push(`Maximum Score must be greater than or equal minimum Score min in section ${index + 1}.`);
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert(messages.join("\n"));
        }
    });
</script>


