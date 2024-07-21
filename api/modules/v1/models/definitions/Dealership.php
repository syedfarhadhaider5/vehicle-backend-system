<?php

namespace api\modules\v1\models\definitions;

/**
 * @SWG\Definition(required={"business_name", "business_phone", "business_fax", "business_address", "business_open_since", "nature_of_business", "business_site", "mailing_business_address",
 *     "dealer_type","entity_type","owner_full_name","owner_title","owner_phone","owner_email","primary_contact_name","primary_contact_title","primary_contact_phone","is_master_dealer_agreement_signed",
 *     "current_package","reviews","rating","created_by","created_at","is_enabled",
 *     })
 *
 * @SWG\Property(property="id", type="integer")
 * @SWG\Property(property="business_name", type="string")
 * @SWG\Property(property="dba", type="string")
 * @SWG\Property(property="business_phone", type="string")
 * @SWG\Property(property="business_fax", type="string")
 * @SWG\Property(property="business_address", type="string")
 *  @SWG\Property(property="business_open_since", format="date")
 *  @SWG\Property(property="nature_of_business", type="string")
 *  @SWG\Property(property="business_site", type="string")
 *  @SWG\Property(property="mailing_business_address", type="string")
 *  @SWG\Property(property="dealer_type", type="integer")
 *  @SWG\Property(property="entity_type", type="string")
 *  @SWG\Property(property="hear_about_us", type="string")
 * @SWG\Property(property="referral_code", type="string")
 * @SWG\Property(property="representative", type="string")
 * @SWG\Property(property="owner_full_name", type="string")
 * @SWG\Property(property="owner_title", type="string")
 * @SWG\Property(property="owner_phone", type="string")
 * @SWG\Property(property="owner_email", type="string")
 * @SWG\Property(property="opening_hours", type="string")
 * @SWG\Property(property="location", type="string")
 * @SWG\Property(property="primary_contact_name", type="string")
 * @SWG\Property(property="primary_contact_title", type="string")
 * @SWG\Property(property="primary_contact_phone", type="string")
 * @SWG\Property(property="is_master_dealer_agreement_signed", type="integer")
 * @SWG\Property(property="current_package", type="string")
 * @SWG\Property(property="reviews", type="string")
 * @SWG\Property(property="rating", type="string")
 * @SWG\Property(property="created_by", type="integer")
 * @SWG\Property(property="created_at", type="string", format="date-time")
 * @SWG\Property(property="is_enabled", type="integer")
 *
 *
 *
 */
class Dealership
{
    // dummy class for Swagger definitions
}
