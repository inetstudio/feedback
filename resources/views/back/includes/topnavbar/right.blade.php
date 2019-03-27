@inject('feedbackService', 'InetStudio\Feedback\Contracts\Services\Back\FeedbackServiceContract')

@php
    $unreadBadge = $feedbackService->getUnreadFeedbackCount();
@endphp

<li class="dropdown">
    <a class="count-info" href="{{ route('back.feedback.index') }}">
        <i class="fa fa-lg fa-envelope"></i>  <span class="label label-primary">{{ $unreadBadge }}</span>
    </a>
</li>
