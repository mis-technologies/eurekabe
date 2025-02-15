<?php

namespace Modules\Common\Providers;
use function Codewithkyrian\Transformers\Pipelines\pipeline;



class TransfomerServiceProvider
{
    
    public static  function  runInPipeline($pipeline, $input)
    {
        $pipe = pipeline($pipeline);
        $output = $pipe($input);

        return $output;
    }
}
