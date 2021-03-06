<?php

namespace yiiunit\swiftmailer;

use Psr\Log\LogLevel;
use Yii;
use yii\swiftmailer\Logger;

class LoggerTest extends TestCase
{
    protected function getLastLogMessage()
    {
        return end(Yii::getLogger()->messages);
    }

    /**
     * Data provider for [[testAdd()]]
     * @return array test data
     */
    public function dataProviderAdd()
    {
        return [
            [
                '>> command sent',
                [
                    'message' => '>> command sent',
                    'level' => LogLevel::INFO,
                ]
            ],
            [
                '<< response received',
                [
                    'message' => '<< response received',
                    'level' => LogLevel::INFO,
                ]
            ],
            [
                '++ transport started',
                [
                    'message' => '++ transport started',
                    'level' => LogLevel::DEBUG,
                ]
            ],
            [
                '!! error message',
                [
                    'message' => '!! error message',
                    'level' => LogLevel::WARNING,
                ]
            ],
        ];
    }

    /**
     * @dataProvider dataProviderAdd
     *
     * @param string $entry
     * @param array $expectedLogMessage
     */
    public function testAdd($entry, array $expectedLogMessage)
    {
        $logger = new Logger();

        $logger->add($entry);

        $logMessage = $this->getLastLogMessage();

        $this->assertEquals($expectedLogMessage['level'], $logMessage[0]);
        $this->assertEquals($expectedLogMessage['message'], $logMessage[1]);
    }
}