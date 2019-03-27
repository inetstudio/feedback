@inject('feedbackService', 'InetStudio\Feedback\Contracts\Services\Back\FeedbackServiceContract')

@php
    $unreadBadge = $feedbackService->getUnreadFeedbackCount();
@endphp

<li class="{{ isActiveRoute('back.feedback.*') }}">
    <a href="{{ route('back.feedback.index') }}"><i class="fa fa-envelope"></i> <span class="nav-label">Обратная связь</span><span class="label label-primary float-right">{{ $unreadBadge }}</span></a>
</li>
