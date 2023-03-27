<template>
    <div class="row">
        <div class="col-lg-12">
            <section class="content">
                <div class="container-fluid">
                    
                    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
                        <h1>{{ title }}</h1>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edición Línea del PAA</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="organizational_area_id">Área Organizativa</label>
                                            <Select2  id="organizational_area_id" v-model="paaLine.organizational_area_id" :options="organizationalAreaOpt" 
                                                placeholder="- Selecciona un organización -" @select="selectOrganizationalArea($event)"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="unspsc">Código UNSPSC</label>
                                            <input type="text" class="form-control" id="unspsc" v-model="paaLine.unspsc" placeholder="UNSPSC">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="description">Descripción</label>
                                            <input type="text" class="form-control" id="description" v-model="paaLine.description" placeholder="Descripción">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="start_date_selection_process">Inicio de proceso de selección</label>
                                            <VueDatePicker v-model="paaLine.start_date_selection_process" auto-apply :enable-time-picker="false" format="dd-MM-yyyy"/>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="contract_duration">Duración del contrato</label>
                                            <input type="text" class="form-control" id="contract_duration" v-model="paaLine.contract_duration" placeholder="Duración del contrato">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="contract_duration">Unidad</label>
                                            <Select2  id="contract_duration_unit_id" v-model="paaLine.contract_duration_unit_id" :options="unitsOpt" 
                                            placeholder="- Selecciona una unidad -" @select="selectUnit($event)" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="selection_method_id">Modalidad de selección</label>
                                            <Select2  id="selection_method_id" v-model="paaLine.selection_method_id" :options="selectionMethodOpt" 
                                            placeholder="- Selecciona una modalidad -" @select="selectSelectionMethod($event)"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="source_funds_id">Fuente de los recursos</label>
                                            <Select2  id="source_funds_id" v-model="paaLine.source_funds_id" :options="sourceFundsOpt" 
                                            placeholder="- Selecciona una fuente -"  @select="selectSourceFunds($event)"/>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="total_amount">Valor total estimado</label>
                                            <input type="text" class="form-control" id="total_amount" v-model="paaLine.total_amount" placeholder="Valor">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="value_current_period">Valor estimado en la vigencia actual</label>
                                            <input type="text" class="form-control" id="value_current_period" v-model="paaLine.value_current_period" placeholder="Valor">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group toogle-row">
                                            <label for="future_periods_required">¿Se requieren vigencias futuras?</label>
                                            <Toggle v-model="paaLine.future_periods_required" id="future_periods_required" on-label="SI" off-label="NO"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status_future_periods">Estado de solicitud de vigencias futuras</label>
                                            <input type="text" class="form-control" id="status_future_periods" v-model="paaLine.status_future_periods" placeholder="Estado">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="unit_responsible_id">Dependencia responsable del proceso contractual</label>
                                            <Select2  id="unit_responsible_id" v-model="paaLine.unit_responsible_id" :options="organizationalAreaOpt" 
                                            placeholder="- Selecciona un responsable -" @select="selectOrganizationalAreaResponsible($event)"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="contractor_id">Nombre del contratista</label>
                                            <Select2  id="contractor_id" v-model="paaLine.contractor_id" :options="contractorOpt" 
                                            placeholder="- Selecciona un contratista -" @select="selectContractors($event)"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="contractor_identification">Identificación</label>
                                            <input type="text" class="form-control" id="contractor_identification" v-model="paaLine.contractor_identification" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group toogle-row">
                                            <label for="service_contract">¿Es un contrato de prestación de servicios?</label>
                                            <Toggle v-model="paaLine.service_contract" id="service_contract" on-label="SI" off-label="NO"/>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="service_contract_type_id">Tipo de contrato de prestaciónd de servicios</label>
                                            <Select2  id="service_contract_type_id" v-model="paaLine.service_contract_type_id" :options="serviceContractTypesOpt" 
                                            placeholder="- Selecciona un tipo de contrato -" @select="selectServiceContractType($event)"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="operating_value">Recursos de funcionamiento</label>
                                            <input type="text" class="form-control" id="operating_value" v-model="paaLine.operating_value">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="operating_budget">Rubro de funcionamiento</label>
                                            <input type="text" class="form-control" id="operating_budget" v-model="paaLine.operating_budget">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="investment_value">Recurso de inversión</label>
                                            <input type="text" class="form-control" id="investment_value" v-model="paaLine.investment_value">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="investment_budget">Rubro de inversión</label>
                                            <input type="text" class="form-control" id="investment_budget" v-model="paaLine.investment_budget">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="action_plan_indicator">Plan de acción</label>
                                            <input type="text" class="form-control" id="action_plan_indicator" v-model="paaLine.action_plan_indicator">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="value_resources_other_sources">Recursos de otras fuentes</label>
                                            <input type="text" class="form-control" id="value_resources_other_sources" v-model="paaLine.value_resources_other_sources">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-default" style="margin-right: 25px;" @click="cancel()">Cancelar</button>
                                <button type="button" class="btn btn-primary " @click="savePAALine()">Guardar</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </section>
        </div>
    </div>
</template>
<script>
export default {
    setup: () => ({
        title: "Administración de líneas del PAA",
    }),
    data() {
        return {
            paaLine: {
                organizational_area_id: '',
                organizational_area_cod: '',
                organizational_area_name: '',
                unspsc: '',
                description: '',
                start_date_selection_process: '',
                contract_duration: '',
                contract_duration_unit_id:'',
                contract_duration_unit_name:'',
                selection_method_id:'',
                selection_method_name:'',
                source_funds_id:'',
                source_funds_name:'',
                total_amount:'',
                value_current_period:'',
                future_periods_required:false,
                status_future_periods:'',
                unit_responsible_id:'',
                unit_responsible_name:'',
                unit_responsible_cod:'',
                contractor_id:'',
                contractor_identification:'',
                contractor_name:'',
                service_contract:false,
                service_contract_type_id:'',
                service_contract_type_name:'',
                operating_value:'',
                operating_budget:'',
                investment_value:'',
                investment_budget:'',
                action_plan_indicator:'',
                value_resources_other_sources:'',
            },
            organizationalAreaOpt: [],
            unitsOpt: [],
            selectionMethodOpt:[],
            sourceFundsOpt:[],
            unitResponsibleOpt:[],
            contractorOpt:[],
            serviceContractTypesOpt:[],
        };
    },
    methods :{
        selectOrganizationalArea(el) {
            this.paaLine.organizational_area_cod = el.dependecy_id;
            this.paaLine.organizational_area_name = el.text;
        },
        
        selectUnit(el) {
            this.paaLine.contract_duration_unit_name = el.text;
        },

        selectSelectionMethod(el) {
            this.paaLine.selection_method_name = el.text;
        },

        selectSourceFunds(el) {
            this.paaLine.source_funds_name = el.text;
        },

        selectOrganizationalAreaResponsible(el) {
            this.paaLine.unit_responsible_cod = el.dependecy_id;
            this.paaLine.unit_responsible_name = el.text;
        },

        selectContractors(el) {
            this.paaLine.contractor_identification = el.identification;
            this.paaLine.contractor_name = el.text;
        },

        selectServiceContractType(el) {
            this.paaLine.service_contract_type_name = el.text;
        },
        
        
        getOrganizationalArea() {
            axios
                .get(this.urlPlatform+'/api/areas/select',{
                    headers: {
                        'Authorization': 'Bearer '+this.AccessToken
                    }
                })
                .then(response => {
                    this.organizationalAreaOpt = response.data;
                    console.log(this.organizationalAreaOpt);
                })
        },

        getUnit() {
            axios
                .get(this.urlPlatform+'/api/contract-duration-units/select',{
                    headers: {
                        'Authorization': 'Bearer '+this.AccessToken
                    }
                })
                .then(response => {
                    this.unitsOpt = response.data;
                })
        },

        getSelectionMethod() {
            axios
                .get(this.urlPlatform+'/api/selection-methods/select',{
                    headers: {
                        'Authorization': 'Bearer '+this.AccessToken
                    }
                })
                .then(response => {
                    this.selectionMethodOpt = response.data;
                })
        },

        getSourceFunds() {
            axios
                .get(this.urlPlatform+'/api/source-funds/select',{
                    headers: {
                        'Authorization': 'Bearer '+this.AccessToken
                    }
                })
                .then(response => {
                    this.sourceFundsOpt = response.data;
                })
        },

        getContractors() {
            axios
                .get(this.urlPlatform+'/api/contractors/select',{
                    headers: {
                        'Authorization': 'Bearer '+this.AccessToken
                    }
                })
                .then(response => {
                    this.contractorOpt = response.data;
                })
        },

        getServiceContractTypes() {
            axios
                .get(this.urlPlatform+'/api/service-contract-types/select',{
                    headers: {
                        'Authorization': 'Bearer '+this.AccessToken
                    }
                })
                .then(response => {
                    this.serviceContractTypesOpt = response.data;
                })
        },

        getPAALine(padId,lineId) {
            axios
                .get('/api/paas/'+padId+'/lines/'+lineId,{
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.paaLine = response.data;
                })
        },

        savePAALine() {
            if (this.paaLine.id) {
                this.updatePAALine();
            } else {
                this.createPAALine();
            }
        },

        createPAALine() {
            axios
                .post('/api/paas/'+this.paaLine.paa_id+'/lines', this.paaLine, {
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.paaLine = response.data;
                    this.$swal('¡Se guardo la Línea del PAA correctamente!');
                    this.$router.push({ name: 'paas-edit', params:{id:this.paaLine.paa_id} });
                })
                .catch(error => {
                    this.$swal.fire({
                        icon: 'error',
                        title: 'Se presento un error al guardar la Línea del PAA!',
                        text: '',
                        footer: ''
                    })
                });
        },

        updatePAALine() {
            axios
                .put('/api/paas/'+this.paaLine.paa_id+'/lines/'+this.paaLine.id, this.paaLine, {
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.paaLine = response.data;
                    this.$swal('¡Se actualizo la Línea del PAA correctamente!');
                    this.$router.push({ name: 'paas-edit', params:{id:this.paaLine.paa_id} });
                })
                .catch(error => {
                    this.$swal.fire({
                        icon: 'error',
                        title: 'Se presento un error al actualizar la Línea del PAA!',
                        text: '',
                        footer: ''
                    })
                });
        },

        cancel() {
            this.$router.push({ name: 'paas-edit', params:{id:this.paaLine.paa_id} });
        }
    },
    mounted () {
        this.getOrganizationalArea();
        this.getUnit();
        this.getSelectionMethod();
        this.getSourceFunds();
        this.getContractors();
        this.getServiceContractTypes();

        const paaId = this.$route.params.id ? this.$route.params.id : 0;
        const paaLineId = this.$route.params.lineId ? this.$route.params.lineId : 0;
        if (paaLineId > 0) {
            this.getPAALine(paaId,paaLineId);
        } else {
            this.paaLine = {
                paa_id:paaId,
                organizational_area_id: '',
                organizational_area_cod: '',
                organizational_area_name: '',
                unspsc: '',
                description: '',
                start_date_selection_process: '',
                contract_duration: '',
                contract_duration_unit_id:'',
                contract_duration_unit_name:'',
                selection_method_id:'',
                selection_method_name:'',
                source_funds_id:'',
                source_funds_name:'',
                total_amount:'',
                value_current_period:'',
                future_periods_required:false,
                status_future_periods:'',
                unit_responsible_id:'',
                unit_responsible_name:'',
                unit_responsible_cod:'',
                contractor_id:'',
                contractor_identification:'',
                contractor_name:'',
                service_contract:false,
                service_contract_type_id:'',
                service_contract_type_name:'',
                operating_value:'',
                operating_budget:'',
                investment_value:'',
                investment_budget:'',
                action_plan_indicator:'',
                value_resources_other_sources:'',
            }
        }
    }
};
</script>
