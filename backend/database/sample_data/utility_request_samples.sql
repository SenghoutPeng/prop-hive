INSERT INTO utility_request (
    user_id, property_id, utility_request_description, utility_request_status, utility_request_created_at, utility_request_responded_at
) VALUES
(1, 2, 'Request for water supply repair in apartment 2A.', 'Pending', NOW(), NULL),
(3, 5, 'Electricity outage reported in unit 5B.', 'In Progress', NOW(), NULL),
(2, 4, 'Request for garbage collection service.', 'Completed', NOW(), NOW());
