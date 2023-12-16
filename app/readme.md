# Structure tables
Client
    id                      (client)
    access_token
    executed_at

Bitrix
    id                      
    client                 (Client > id) one to one
    domain_url
    plan_id       
    member_id
    access_token
    refresh_token
    expires_on
    executed_at

Getresponse
    id
    client                (Client > id) one to one
    plan_id
    access_token
    executed_at

Section
    id 
    client              (Client > id) one to one
    list_id                 (getresponse list of sync)
    pipeline_id             (bitrix pipeline of sync)
    executed_at

Field
    id
    client             (Client > id) one to one
    entity_id
    bitrix_id
    getresponse_id
    executed_at

Event
    id 
    client             (Client > id) many to one
    type_id
    stage_id
    executed_at