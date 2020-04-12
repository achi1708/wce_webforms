@extends('layout')

@section('content')
<div id="wrapper">
<form id="sqrf_form" name="sqrf_form" method="post">
	<div class="form-group">
		<label for="requesttype" data-label="Solicitud que deseas enviar">Solicitud que deseas enviar</label>
		<select class="form-control" id="requesttype" name="requesttype" required>
		  <option value="">--Seleccione--</option>
	      <option value="S">Sugerencia</option>
	      <option value="Q">Queja</option>
	      <option value="R">Reclamo</option>
	      <option value="F">Felicitación</option>
	    </select>
	</div>
	<div class="form-group">
		<label for="name_person_company" data-label="Nombres y Apellidos / Razón Social">Nombres y Apellidos / Razón Social</label>
		<input type="text" class="form-control" id="name_person_company" name="name_person_company" required>
	</div>
	<div class="form-group">
		<label for="address_person_company" data-label="Dirección completa y Ciudad">Dirección completa y Ciudad</label>
		<input type="text" class="form-control" id="address_person_company" name="address_person_company" required>
	</div>
	<div class="form-group">
		<label for="telephone_person_company" data-label="Teléfono">Teléfono</label>
		<input type="number" class="form-control" id="telephone_person_company" name="telephone_person_company" required placeholder="0573100000000" max="9999999999999">
	</div>
	<div class="form-group">
		<label for="email_person_company" data-label="E-mail">E-mail</label>
		<input type="email" class="form-control" id="email_person_company" name="email_person_company" required>
	</div>
	<div class="form-group">
		<label for="role_person_company" data-label="Nos escribe en calidad de">Nos escribe en calidad de</label>
		<select class="form-control" id="role_person_company" name="role_person_company" required>
		  <option value="">--Seleccione--</option>
	      <option value="natural_person_client">Cliente - persona natural</option>
	      <option value="agency_client">Cliente - Agencia de turismo</option>
	      <option value="supplier">Proveedor</option>
	    </select>
	</div>
	<div class="form-group">
		<label for="represent_for" data-label="En representación de (su nombre o nombre de la persona que representa)">En representación de (su nombre o nombre de la persona que representa)</label>
		<input type="text" class="form-control" id="represent_for" name="represent_for" required>
	</div>
	<div class="form-group">
		<label for="sqrf_subject" data-label="Asunto">Asunto</label>
		<input type="text" class="form-control" id="sqrf_subject" name="sqrf_subject" required>
	</div>
	<div class="form-group">
		<label for="sqrf_description" data-label="Descripción de la Sugerencia, Queja, Reclamo o Felicitación">Descripción de la Sugerencia, Queja, Reclamo o Felicitación</label>
		<textarea class="form-control" id="sqrf_description" name="sqrf_description" rows="3" required style="resize:none;"></textarea>
	</div>
	<div class="form-group">
		<i>La respuesta a su solicitudle será enviada en máximo de 15 días hábiles</i>
	</div>
	<div id='recaptcha' class="g-recaptcha" data-sitekey="6LfKddkUAAAAAEoCC2ZSfvRZJrPD6lfaIK9EKTxA" data-callback="nlej5rntje462l5" data-size="invisible"></div>
	<button id="sqrf_submit" name="sqrf_submit" type="button" class="btn btn-primary">Enviar</button>
</form>
</div>

<script type="text/javascript" src="{{ URL::asset('js/sqrf.controller.js') }}"></script>

@stop