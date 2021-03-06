<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {

  public function __construct() {
    parent::__construct();
		$this->load->model('pages_model');
  }

  /**
   * Index
   */
  public function index() {
    redirect('/');
  }

  /**
   * View (default controller)
   *
   * This is the default controller for public, static pages. Just add your view
   * to the "/views/public" directory. You do not need to configure a route for 
   * your view. If your view file's name is "help.php", just visit the
   * URI "/help", and the page will load automagically.
   */
	public function view($page = 'about')
	{
  	if (file_exists('application/views/pages/'.$page.'.php'))
  	{
  	  $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['content'] = 'pages/'.$page;
  	  $this->load->view($this->public_layout, $data);
  	}
    else {
  		// Whoops, we don't have a page for that!
  		show_404();
    }
	}

  /**
   * Doc
   *
   * Show the API documentation page.
   */
	public function doc()
	{
    $data['title'] = 'Documentation';
    $data['content'] = 'pages/doc';
    $data['versions'] = $this->pages_model->get_all_version_info();
    // Regular fields/keys (table values)
    $data['reg_fields'] = array(
                    'id' => 'Internal; used to organize data.',
                    'hgvs_protein_change' => 'HGVS Protein Change',
                    'hgvs_nucleotide_change' => 'HGVS Nucleotide Change',
                    'variantlocale' => 'Exonic or Intronic position of variant',
                    'variation' => 'HGVS Genomic Position',
                    'pathogenicity' => 'Pathogenicity',
                    'disease' => 'Disease',
                    'pubmed_id' => 'Pubmed ID',
                    'dbsnp' => 'dbSNP ID',
                    'gene' => 'Gene',
                    'phylop_score' => 'PhyloP Score',
                    'phylop_pred' => 'PhyloP Prediction',
                    'sift_score' => 'SIFT Score',
                    'sift_pred' => 'SIFT Prediction',
                    'polyphen2_score' => 'PolyPhen2 Score',
                    'polyphen2_pred' => 'PolyPhen2 Prediction',
                    'lrt_score' => 'LRT Score',
                    'lrt_pred' => 'LRT Prediction',
                    'mutationtaster_score' => 'MutationTaster Score',
                    'mutationtaster_pred' => 'MutationTaster Prediction',
                    'gerp_rs' => 'GERP++ Rejected Substitutions Score',
                    'gerp_nr' => 'GERP++ Neutral Rate',
                    'gerp_pred' => 'GERP++ Prediction',
    );
    $data['reg_keys'] = array_keys($data['reg_fields']);
    // Population fields/keys (table values)
    $data['pop_fields'] = array(
                    'evs_ea_*' => 'European American Alternate Allele Count',
                    'evs_aa_*' => 'African American Total Allele Count',
                    'tg_acb_*' => 'African Caribbean in Barbados',
                    'tg_asw_*' => 'African Ancestry in Southwest US',
                    'tg_cdx_*' => 'Chinese Dai in Xishuangbanna',
                    'tg_ceu_*' => 'Utah residents, Northern and Western European ancestry',
                    'tg_chb_*' => 'Han Chinese in Beijing, China',
                    'tg_chs_*' => 'Han Chinese South',
                    'tg_clm_*' => 'Colombian in Medellin, Colombia ',
                    'tg_fin_*' => 'Finnish from Finland',
                    'tg_gbr_*' => 'British from England and Scotland',
                    'tg_gih_*' => 'Gujarati Indian in Houston, TX',
                    'tg_ibs_*' => 'Iberian populations in Spain',
                    'tg_jpt_*' => 'Japanese in Toyko, Japan',
                    'tg_khv_*' => 'Kinh in Ho Chi Minh City, Vietnam',
                    'tg_lwk_*' => 'Luhya in Webuye, Kenya',
                    'tg_mxl_*' => 'Mexican Ancestry in Los Angeles, CA',
                    'tg_pel_*' => 'Peruvian in Lima, Peru',
                    'tg_pur_*' => 'Puerto Rican in Puerto Rico',
                    'tg_tsi_*' => 'Toscani in Italia',
                    'tg_yri_*' => 'Yoruba in Ibadan, Nigeria ',
    );
    $data['pop_keys'] = array_keys($data['pop_fields']);
    $this->load->view($this->public_layout, $data);
	}

  /**
   * Letter
   *
   * Display all genes that begin with $letter.
   */
	public function letter($letter)
	{
    $data['title'] = strtoupper($letter);
    $data['content'] = 'pages/doc';
    $this->load->view($this->public_layout, $data);
	}
}
