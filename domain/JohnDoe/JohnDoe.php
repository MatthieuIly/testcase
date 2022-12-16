<?php

namespace JohnDoe;

class JohnDoe
{
    /**
     */
    public function __construct()
    {
        //
    }

    /**
     * @param JohnDoeRequest $request
     * @param JohnDoePresenterInterface $presenter
     */
    public function execute($request, $presenter)
    {
        $presenter->present(new JohnDoeResponse());
    }
}
