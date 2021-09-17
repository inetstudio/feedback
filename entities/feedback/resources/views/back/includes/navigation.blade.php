@inject('feedbackService', 'InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ItemsServiceContract')

@php
    $unreadBadge = $feedbackService->getUnreadItemsCount();
@endphp

<li class="{{ isActiveRoute('back.feedback.*', 'mm-active') }}">
    <a href="{{ route('back.feedback.index') }}"><i class="fa fa-envelope"></i> <span class="nav-label">Обратная связь</span><span class="label label-primary float-right">{{ $unreadBadge }}</span></a>
</li>
