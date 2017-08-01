<?php

namespace Ruth\Api\Foundation;

class Pager
{
    private $data;
    private $core;

    public function __construct(Core $core, $data = [])
    {
        $this->core = $core;
        $this->data = $data;
    }

    /**
     * Sets the pagination infomation.
     * @param array $data
     */
    public function setData($data = [])
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the next set of responses.
     * @return mixed
     */
    public function next()
    {
        if (!array_key_exists('nextPage', $this->data)) {
            return;
        }

        return $this->core->request('GET', $this->data['nextPage']);
    }

    /**
     * Get the prev set of responses.
     * @return mixed
     */
    public function prev()
    {
        if (!array_key_exists('prevPage', $this->data)) {
            return;
        }

        return $this->core->request('GET', $this->data['prevPage']);
    }
}
