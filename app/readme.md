# Structure tables
Client
    id                      (client_id) 
    bitrix_id
    bitrix_domain
    bitrix_plan
    getresponse_plan
    app_version
    app_instaled
    executed_at

Access 
    id 
    client_id               (Client > id) one to one
    bitrix_token
    bitrix_refresh_token
    bitrix_expires_token
    getresponse_token
    app_hook
    executed_at

Category
    id 
    client_id               (Client > id) one to one
    getresponse             (list of sync)
    bitrix                  (pipeline of sync)
    executed_at

Field
    id
    client_id               (Client > id) many to one
    entity
    bitrix
    getresponse
    executed_at

Event
    id 
    client_id               (Client > id) many to one
    type
    stage
    executed_at