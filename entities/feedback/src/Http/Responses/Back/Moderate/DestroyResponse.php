<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Moderate;

use InetStudio\AdminPanel\Base\Http\Responses\BaseResponse;
use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ModerateServiceContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract;

/**
 * Class DestroyResponse.
 */
class DestroyResponse extends BaseResponse implements DestroyResponseContract
{
    /**
     * @var ModerateServiceContract
     */
    protected $moderateService;

    /**
     * DestroyResponse constructor.
     *
     * @param  ModerateServiceContract  $moderateService
     */
    public function __construct(ModerateServiceContract $moderateService)
    {
        $this->moderateService = $moderateService;
    }

    /**
     * Prepare response data.
     *
     * @param $request
     *
     * @return array
     */
    protected function prepare($request): array
    {
        $ids = $request->get('feedback') ?? [];

        $result = $this->moderateService->destroy($ids);

        return [
            'success' => $result,
        ];
    }
}
