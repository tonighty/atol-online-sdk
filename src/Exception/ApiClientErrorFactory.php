<?php

namespace Majorov\AtolOnlineSdk\Exception;

final class ApiClientErrorFactory
{
    private const ERROR_BY_CODE = [
        0 => UndefinedError::class,
        1 => IncomingChequeProcessingFailedError::class,
        10 => MissingTokenError::class,
        11 => ExpiredTokenError::class,
        12 => WrongLoginOrPasswordError::class,
        13 => ValidationExceptionError::class,
        14 => UserBlockedError::class,
        20 => GroupCodeAndTokenDontMatchError::class,
        21 => NotSupportedGroupCodeForProtocolError::class,
        30 => MissingUuidError::class,
        31 => IncomingOperationNotSupportedError::class,
        32 => IncomingValidationExceptionError::class,
        33 => IncomingExternalIdAlreadyExistsError::class,
        34 => StateCheckNotFoundError::class,
        40 => BadRequestError::class,
        41 => UnsupportedMediaTypeError::class,
        50 => ErrorServerConfigurationError::class,
    ];

    public function createException(?int $errorCode, ?string $message): ApiClientError
    {
        $exceptionClass = self::ERROR_BY_CODE[$errorCode] ?? UnknownError::class;

        return new $exceptionClass($message);
    }
}