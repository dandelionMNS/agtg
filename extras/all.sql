INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `position`, `phone_no`, `address`, `gender`, `age`, `leave_remaining`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$ZjTQz8WjoobNoLZF2s3S2.o9Xpy1/a7W87VHovsZvNjycGeevEpL.', 'admin', '0123456789', 'Address Admin', NULL, '24', 20, NULL, '2024-06-23 04:02:04', '2024-06-23 04:10:24'),
(2, 'employee1', 'employee1@gmail.com', NULL, '$2y$12$M5lxBEPJbIjWmMwkVz2BF.oUgw0C0jjc3udL6ibH9ta6cqOfSIYbu', 'employee', '0112345678', 'Jalan Employee 1', NULL, '18', 20, NULL, '2024-06-23 04:02:33', '2024-06-23 04:10:56'),
(3, 'employee2', 'employee2@gmail.com', NULL, '$2y$12$.XV0IRZqFmMP48neAJ3XY.CjME4m18V7y..cSxCtTldbxqNR5zecu', 'employee', '0123345678', 'Jalan Employee 3', NULL, '23', 20, NULL, '2024-06-23 04:02:56', '2024-06-23 04:12:16'),
(4, 'employee3', 'employee3@gmail.com', NULL, '$2y$12$Vfid6inwNHT.qIja8NyR5e5FX/fkdXlguyXXbav78JIRPpUjDm19C', 'employee', '0123445678', NULL, NULL, NULL, 20, NULL, '2024-06-23 04:03:15', '2024-06-23 04:12:36'),
(5, 'employee4', 'employee4@gmail.com', NULL, '$2y$12$YV8FSqo7OiLxYsQr02Ix4O9gu.MudHbblyxKFyBUoOYys9ZbXsRyO', 'employee', '0123455678', NULL, NULL, NULL, 20, NULL, '2024-06-23 04:03:31', '2024-06-23 04:12:51'),
(6, 'employee5', 'employee5@gmail.com', NULL, '$2y$12$fJJlCpInGcrQXOd38CO1cuXXzh15vVJ50yudjBWDmBKbmDSoN87ZG', 'employee', '0123456678', NULL, NULL, NULL, 20, NULL, '2024-06-23 04:03:51', '2024-06-23 04:13:05'),
(7, 'supervisor1', 'supervisor1@gmail.com', NULL, '$2y$12$.JBdoXRlkfNg5Ta1.x0veOQDFuqqTwEAv/Y7Bc1JkqfpQpXr/KFqe', 'supervisor', '0122345678', 'Jalan Supervisor 1', NULL, '32', 20, NULL, '2024-06-23 04:04:15', '2024-06-23 04:11:31'),
(8, 'supervisor2', 'supervisor2@gmail.com', NULL, '$2y$12$ObAkBbmjcM5eIdCZndx8WuOmw8dXVR/I2L5o1PgB08wHwvcoF7mVe', 'supervisor', '0123456778', NULL, NULL, NULL, 20, NULL, '2024-06-23 04:06:42', '2024-06-23 04:13:29'),
(9, 'employee6', 'employee6@gmail.com', NULL, '$2y$12$WYORYxWMljkDsHJ4GUrFs.ow0Gzn5gZqcIIa.yia3F8imFyC8yvDO', 'employee', '0123456789', NULL, NULL, NULL, 20, NULL, '2024-06-23 04:09:46', '2024-06-23 04:13:46');


INSERT INTO `leave_types` (`id`, `name`) VALUES
(1, 'Annual Leave'),
(2, 'Emergency Leave'),
(3, 'MC Leave'),
(4, 'Maternity Leave'),
(5, 'Marriage Leave');

INSERT INTO `leaves` (`id`, `user_id`, `leave_type_id`, `documents`, `start`, `end`, `status`, `created_at`, `updated_at`) VALUES
(21, 2, 1, 'documents/21.pdf', '2024-06-01', '2024-06-01', 'Approved', '2024-06-23 17:14:17', '2024-06-25 00:01:24'),
(22, 2, 1, 'documents/22.jpg', '2024-06-01', '2024-07-06', 'Rejected', '2024-06-23 17:14:36', '2024-06-25 00:01:09');

INSERT INTO `duty_types` (`id`, `name`) VALUES
(1, 'Cashier '),
(2, 'Waiter '),
(3, 'Kitchen helper'),
(4, 'Drink maker');

