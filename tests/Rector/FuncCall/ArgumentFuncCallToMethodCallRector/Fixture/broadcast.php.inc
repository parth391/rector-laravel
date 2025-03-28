<?php

namespace RectorLaravel\Tests\Rector\FuncCall\ArgumentFuncCallToMethodCallRector\Fixture;

class Broadcast
{
    public function action()
    {
        return broadcast('template.blade');
    }
}

?>
-----
<?php

namespace RectorLaravel\Tests\Rector\FuncCall\ArgumentFuncCallToMethodCallRector\Fixture;

class Broadcast
{
    public function __construct(private readonly \Illuminate\Contracts\Broadcasting\Factory $broadcastingFactory)
    {
    }
    public function action()
    {
        return $this->broadcastingFactory->event('template.blade');
    }
}

?>
