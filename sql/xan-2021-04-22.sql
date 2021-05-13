DROP TABLE IF EXISTS `APIRequests`;
CREATE TABLE `APIRequests`
(
    `Auth`                varchar(255)                                            DEFAULT NULL,
    `Action`              varchar(255)                                            DEFAULT NULL,
    `ActionID`            varchar(255)                                            DEFAULT NULL,
    `RequestTS`           datetime                                                DEFAULT NULL,
    `RequestIsProcessed`  varchar(3)                                              DEFAULT NULL,
    `RequestIsSent`       varchar(3)                                              DEFAULT NULL,
    `RequestData`         text,
    `ResponseAuth`        varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `ResponseURL`         varbinary(255)                                          DEFAULT NULL,
    `ResponseTS`          timestamp    NULL                                       DEFAULT NULL,
    `ResponseIsProcessed` varchar(3)                                              DEFAULT NULL,
    `ResponseData`        text,
    `ResponseCode`        varchar(255)                                            DEFAULT NULL,
    `ResponseMessage`     text,
    `Log`                 text,
    `UUIDAPIRequests`        varchar(255) NOT NULL,
    PRIMARY KEY (`UUIDAPIRequests`) USING BTREE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;