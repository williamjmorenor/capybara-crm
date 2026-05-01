<?php

/**
 * Capybara CRM — Cadenas de texto en español.
 *
 * Uso en vistas:  <?= lang('Crm.key') ?>
 */

return [

    // ----------------------------------------------------------------
    // Navegación / Diseño
    // ----------------------------------------------------------------
    'nav_dashboard'    => 'Panel de control',
    'nav_contacts'     => 'Contactos',
    'nav_leads'        => 'Prospectos',
    'nav_opportunities'=> 'Oportunidades',
    'nav_activities'   => 'Actividades',
    'nav_tags'         => 'Etiquetas',
    'logout'           => 'Cerrar sesión',
    'page_title_suffix'=> 'Capybara CRM',
    'app_name'         => 'Capybara CRM',
    'app_subtitle'     => 'Customer Relationship Manager',

    // ----------------------------------------------------------------
    // Autenticación
    // ----------------------------------------------------------------
    'sign_in_subtitle' => 'Inicia sesión en tu cuenta',
    'email_address'    => 'Correo electrónico',
    'password'         => 'Contraseña',
    'sign_in'          => 'Iniciar sesión',

    // ----------------------------------------------------------------
    // Acciones / Etiquetas comunes
    // ----------------------------------------------------------------
    'back'             => 'Volver',
    'edit'             => 'Editar',
    'save_changes'     => 'Guardar cambios',
    'cancel'           => 'Cancelar',
    'delete'           => 'Eliminar',
    'search'           => 'Buscar',
    'filter'           => 'Filtrar',
    'clear'            => 'Limpiar',
    'actions'          => 'Acciones',
    'view_all'         => 'Ver todo',
    'none_option'      => '— Ninguno —',
    'add_activity'     => 'Agregar actividad',
    'no_activities'    => 'Sin actividades aún.',

    // Campos comunes
    'name'             => 'Nombre',
    'email'            => 'Correo electrónico',
    'phone'            => 'Teléfono',
    'company'          => 'Empresa',
    'status'           => 'Estado',
    'notes'            => 'Notas',
    'created'          => 'Creado',
    'type'             => 'Tipo',
    'description'      => 'Descripción',
    'date'             => 'Fecha',
    'related'          => 'Relacionado',
    'title'            => 'Título',
    'contact'          => 'Contacto',
    'color'            => 'Color',
    'preview'          => 'Vista previa',

    // Valores de estado
    'status_active'      => 'Activo',
    'status_inactive'    => 'Inactivo',
    'status_new'         => 'Nuevo',
    'status_contacted'   => 'Contactado',
    'status_qualified'   => 'Calificado',
    'status_lost'        => 'Perdido',
    'status_in_progress' => 'En progreso',
    'status_negotiation' => 'Negociación',
    'status_won'         => 'Ganado',
    'setup'              => 'Configuración',
    'user_global_settings' => 'Configuración global de usuario de la aplicación.',
    'setup_description'  => 'Usa esta página para configurar valores globales de usuario y ajustes de administración.',
    'default_user_role'  => 'Rol de usuario predeterminado',
    'default_user_role_description' => 'El rol asignado a los usuarios nuevos por defecto.',
    'require_password_reset' => 'Requerir restablecimiento de contraseña',
    'require_password_reset_description' => 'Forzar a los usuarios a restablecer su contraseña en el siguiente inicio de sesión.',
    'setup_admin_only_note' => 'Esta sección solo está disponible para administradores.',

    // ----------------------------------------------------------------
    // Panel de control
    // ----------------------------------------------------------------
    'total_contacts'       => 'Total de contactos',
    'total_leads'          => 'Total de prospectos',
    'active_opportunities' => 'Oportunidades activas',
    'recent_activities'    => 'Actividades recientes',
    'leads_by_status'      => 'Prospectos por estado',
    'no_recent_activities' => 'Sin actividades recientes.',

    // ----------------------------------------------------------------
    // Contactos
    // ----------------------------------------------------------------
    'contacts'              => 'Contactos',
    'new_contact'           => 'Nuevo contacto',
    'create_contact'        => 'Crear contacto',
    'edit_contact'          => 'Editar contacto',
    'contact_details'       => 'Detalles del contacto',
    'search_contacts'       => 'Buscar por nombre, correo o empresa…',
    'no_contacts'           => 'No se encontraron contactos.',
    'create_first_contact'  => 'Crear el primer contacto',
    'delete_contact_confirm'=> '¿Eliminar este contacto?',

    // ----------------------------------------------------------------
    // Prospectos
    // ----------------------------------------------------------------
    'leads'               => 'Prospectos',
    'new_lead'            => 'Nuevo prospecto',
    'create_lead'         => 'Crear prospecto',
    'edit_lead'           => 'Editar prospecto',
    'lead_details'        => 'Detalles del prospecto',
    'search_leads'        => 'Buscar por nombre o correo…',
    'all_statuses'        => 'Todos los estados',
    'no_leads'            => 'No se encontraron prospectos.',
    'delete_lead_confirm' => '¿Eliminar este prospecto?',
    'source'              => 'Fuente',
    'estimated_value'     => 'Valor estimado ($)',
    'est_value'           => 'Val. estimado',
    'assigned_to'         => 'Asignado a',
    'unassigned'          => 'Sin asignar',
    'source_web'          => 'Web',
    'source_referral'     => 'Referido',
    'source_manual'       => 'Manual',
    'source_other'        => 'Otro',
    'convert_to_contact'      => 'Convertir a contacto',
    'convert_lead_title'      => 'Convertir prospecto a contacto',
    'convert_lead_body'       => 'Se creará un nuevo contacto con los datos del prospecto y el prospecto quedará archivado.',
    'yes_convert'             => 'Sí, convertir',
    'convert_pipeline_hint'   => 'Convierte este prospecto en contacto para avanzar en el pipeline.',
    'convert_lead_confirm'    => '¿Convertir este prospecto a contacto?',

    // ----------------------------------------------------------------
    // Oportunidades
    // ----------------------------------------------------------------
    'opportunities'              => 'Oportunidades',
    'new_opportunity'            => 'Nueva oportunidad',
    'create_opportunity'         => 'Crear oportunidad',
    'edit_opportunity'           => 'Editar oportunidad',
    'opportunity_details'        => 'Detalles de la oportunidad',
    'amount'                     => 'Monto ($)',
    'profile'                    => 'Mi Perfil',
    'profile_password_hint'      => 'Deja en blanco para mantener tu contraseña actual.',
    'amount_label'               => 'Monto',
    'close_date'                 => 'Fecha de cierre',
    'no_opportunities'           => 'Sin oportunidades',
    'delete_opportunity_confirm' => '¿Eliminar?',

    // ----------------------------------------------------------------
    // Actividades
    // ----------------------------------------------------------------
    'activities'              => 'Actividades',
    'new_activity'            => 'Nueva actividad',
    'create_activity'         => 'Crear actividad',
    'edit_activity'           => 'Editar actividad',
    'all_types'               => 'Todos los tipos',
    'no_activities_found'     => 'No se encontraron actividades.',
    'delete_activity_confirm' => '¿Eliminar esta actividad?',
    'related_to'              => 'Relacionado con',
    'related_id_label'        => 'ID relacionado',
    'related_id_placeholder'  => 'ej. 1',
    'type_call'               => 'Llamada',
    'type_email'              => 'Correo',
    'type_meeting'            => 'Reunión',
    'type_note'               => 'Nota',
    'related_lead'            => 'Prospecto',
    'related_contact'         => 'Contacto',
    'related_opportunity'     => 'Oportunidad',

    // ----------------------------------------------------------------
    // Etiquetas
    // ----------------------------------------------------------------
    'tags'               => 'Etiquetas',
    'new_tag'            => 'Nueva etiqueta',
    'create_tag'         => 'Crear etiqueta',
    'edit_tag'           => 'Editar etiqueta',
    'no_tags'            => 'Sin etiquetas aún.',
    'create_first_tag'   => 'Crear la primera etiqueta',
    'delete_tag_confirm' => '¿Eliminar esta etiqueta?',
    'color_hint'         => 'Elige un color para la etiqueta',

];
