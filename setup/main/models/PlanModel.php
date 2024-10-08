<?php 
class PlanModel extends MY_Model{
    public $table = 'ab_plan';
    
    function getAllPlans(){
        log_message('info', 'Fetching all plans.');
        return $this->get();
    }

    function getAllActivePlans(){
        log_message('info', 'Fetching all active plans.');
        return $this->get(['status' => 1]);
    }

    function getPlanDetails($id){
        log_message('info', "Fetching plan details for plan ID: {$id}");
        
        // Fetch the plan based on the ID
        $plan = $this->get(['id' => $id]);
        
        if ($plan->num_rows()) {
            log_message('debug', "Plan found for ID: {$id}");

            // Retrieve the first row of the plan
            $plan = $plan->row();
            $permissions = $plan->permissions; // Permissions stored as JSON (e.g. {"1":"on","2":1})

            if (empty($permissions)) {
                log_message('error', "Permissions are empty for plan ID: {$id}");
                return ['status' => false, 'msg' => 'Permissions are empty'];
            }

            $plan->permissions_details = [];
            $prms = json_decode($permissions, true);

            foreach ($prms as $pluginid => $permission) {
                log_message('debug', "Fetching plugin details for plugin ID: {$pluginid}");
                $plugin = $this->db->get_where('ab_plugins', ['id' => $pluginid]);

                if ($plugin->num_rows()) {
                    $pluginDetails = $plugin->row_array();
                    $pluginDetails['permission_value'] = $permission;
                    $plan->permissions_details[$pluginid] = $pluginDetails;
                    log_message('debug', "Plugin found for ID: {$pluginid} with permission: {$permission}");
                } else {
                    log_message('error', "Plugin not found for ID: {$pluginid}");
                    $plan->permissions_details[$pluginid] = [
                        'error' => 'Plugin not found',
                        'permission_value' => $permission
                    ];
                }
            }

            log_message('info', "Returning plan details for ID: {$id}");
            return ['status' => true, 'plan' => $plan];
        } else {
            log_message('error', "Plan not found for ID: {$id}");
            return ['status' => false, 'msg' => 'Plan not found'];
        }
    }

    function getPermissionValue($pluginPath){
        log_message('info', "Fetching permission value for plugin path: {$pluginPath}");
        
        $webPlanId = PLANID; // Assuming PLANID is predefined
        $plan = $this->get(['id' => $webPlanId]);

        if ($plan->num_rows()) {
            $plan = $plan->row();
            $permissions = $plan->permissions;

            if (empty($permissions)) {
                log_message('error', "Permissions are empty for plan ID: {$webPlanId}");
                return ['status' => false, 'msg' => 'Permissions are empty'];
            }

            $prms = json_decode($permissions, true);
            $plugin = $this->db->get_where('ab_plugins', ['path' => $pluginPath]);

            if ($plugin->num_rows()) {
                $pluginData = $plugin->row();
                $pluginId = $pluginData->id;

                if (isset($prms[$pluginId])) {
                    log_message('info', "Permission found for plugin path: {$pluginPath} with value: {$prms[$pluginId]}");
                    return ['status' => true, 'permission_value' => $prms[$pluginId]];
                } else {
                    log_message('error', "No permission set for plugin ID: {$pluginId}");
                    return ['status' => false, 'msg' => 'No permission set for this plugin'];
                }
            } else {
                log_message('error', "Plugin not found for path: {$pluginPath}");
                return ['status' => false, 'msg' => 'Plugin not found'];
            }
        } else {
            log_message('error', "Plan not found for ID: {$webPlanId}");
            return ['status' => false, 'msg' => 'Plan not found'];
        }
    }
}
