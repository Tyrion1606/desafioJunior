<?php

namespace App\Validates\Validate;

use App\Exceptions\SystemException;
use App\Traits\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use stdClass;
use Throwable;

class Validate
{
    use Requests;

    protected $rules = [];

    protected $messages = [];

    /**
     * @param stdClass $params
     * @param string|null $message
     * @throws Throwable
     */
    public function validateParameters(stdClass $params, string $message = null) : void
    {
        $validator = Validator::make((array) $params, $this->getRules(), $this->getMessages());

        if ($validator->fails()) {
            $this->shootExeception(new ValidationException($validator), $message);
        }
    }

    /**
     * @param int $id
     * @throws SystemException
     */
    public function validateInt(int $id)
    {
        if (!is_int($id)) {
            throw new SystemException('Error validating integer.');
        }
    }

    /**
     * @return array
     */
    public function getRules() : array
    {
        return $this->rules;
    }

    /**
     * @return array
     */
    public function getMessages() : array
    {
        return $this->messages;
    }
}
