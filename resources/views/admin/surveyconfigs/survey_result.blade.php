@php
    // Group data by survey_type
    $groupedConfigs = $surveyConfigs->groupBy('survey_type');
@endphp

@foreach ($groupedConfigs as $surveyType => $configs)
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 text-capitalize">{{ $surveyType }} Surveys</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>User Type</th>
                        <th>Typeform ID</th>
                        <th>Typeform Title</th>
                        <th>Typeform Type</th>
                        <th>Notification Frequency</th>
                        <th>Custom Days</th>
                        <th>Survey Notification Status</th>
                        <th>Selected Email</th>
                        <th>Discount Code</th>
                        <th>Discount Type</th>
                        <th>Discount Value</th>
                        <th>Discount Status</th>
                        <th>Score</th>
                        <th>Reward Points</th>
                        <th>Participation Points</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($configs as $index => $config)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $config->user_type }}</td>
                            <td>{{ $config->type_form_id }}</td>
                            <td>{{ $config->type_form_title }}</td>
                            <td>{{ $config->type_form_type }}</td>
                            <td>{{ $config->notification_freq }}</td>
                            <td>{{ $config->custom_days }}</td>
                            <td>{{ $config->survey_notification_status }}</td>
                            <td>{{ $config->selected_email }}</td>
                            <td>{{ $config->discount_code }}</td>
                            <td>{{ $config->discount_type }}</td>
                            <td>{{ $config->discount_value }}</td>
                            <td>{{ $config->discount_status }}</td>
                            <td>{{ $config->score }}</td>
                            <td>{{ $config->reward_points }}</td>
                            <td>{{ $config->participation_points }}</td>
                            <td>{{ $config->status }}</td>
                            <td>{{ $config->created_at }}</td>
                            <td>
                                <a href="{{ route('surveyConfig.edit', $config->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('surveyConfig.destroy', $config->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endforeach
