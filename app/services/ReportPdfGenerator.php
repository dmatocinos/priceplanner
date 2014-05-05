<?php

class ReportPdfGenerator extends TCPDF {
	
	protected $pricing;
	protected $calc;
	protected $user;
	protected $pdf;
	protected $img_path = 'assets/img/pdf';
		
	public function __construct($pricing, $calc)
	{
		parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215.9,279.4), true, 'UTF-8', false);

		$this->pricing = $pricing;
		$this->calc = $calc;
		$this->user = Session::get('practicepro_user');
	}

	public function Header() 
	{
		
	}

	public function Footer() 
	{
		if ($this->getNumPages() == 1) {
			return;					
		} 

		$this->SetY(-24);	
		$this->setTextColor(185, 139, 55);
		$this->SetFont('frabk', '', 10, '', true);

		$this->MultiCell(0, 5, 'Generated by PracticePro', 0, 'R', 0, 0, '', 270, true);
	}
	
	public function setupPdf($params = [])
	{
		
		// set document information
		$this->SetCreator('');
		$this->SetAuthor('PracticePro');
		$this->SetTitle('Price Planner Report');
		$this->SetSubject('PDF Export');

		// set default header data
	//	$this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

		// set header and footer fonts
		$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$this->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
		$this->SetHeaderMargin(8);
		$this->SetFooterMargin(1);		
		//$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		//$this->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$this->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$this->setLanguageArray($l);
		}

		// set font
		$this->setTextColor(0, 0, 0);
		//$this->SetFont('dejavusans', '', 10);
		
		//$this->buildIntroReport();
		//$this->buildReport($params);

	}

	public function buildCoverPage()
	{
		//do not print header and footer in cover page
		$this->setPrintHeader(false);
		$this->setPrintFooter(false);
		
		$this->AddPage();
		
		//pagebreak off to expand images
		$this->SetAutoPageBreak(false,0);
		
		$this->Image($this->img_path . '/cover-bg2.jpg', 0, 0, 215.9,279.4, 'JPEG',null ,null ,2);
	
		// Set some content to print
		$this->SetFont('rockb', '', 26, '', true);
		$this->setTextColor(250, 230, 206);
		$this->MultiCell(190, 5, 'Goodwill', 0, 'C', 0, 0, '', 78, true);

		$this->SetFont('frabk', '', 12, '', true);
		//$this->MultiCell(190, 5, 'Prepared ' . date('F, Y', strtotime($this->business->created_at)), 0, 'C', 0, 0, '', 88, true);

		$this->SetFont('fradmcn', '', 15, '', true);
		$this->setTextColor(204, 0, 0);

		$this->MultiCell(155, 5, 'CONTACT INFORMATION', 0, 'L', 0, 0, '', 240, true);

		$this->SetFont('frabk', '', 10, '', true);
		$this->setTextColor(250, 230, 206);


		$this->MultiCell(0, 5, $this->user->mh2_fname . ', ' . $this->user->mh2_lname, 0, 'L', 0, 0, '', 248, true);
		$this->MultiCell(0, 5, $this->user->mh2_company_address, 0, 'R', 0, 0, '', 248, true);

		//$this->MultiCell(0, 5, Auth::user()->email, 0, 'L', 0, 0, '', 252, true);
		$this->MultiCell(0, 5, '', 0, 'R', 0, 0, '', 252, true);

		$this->MultiCell(0, 5, $this->user->phone, 0, 'L', 0, 0, '', 256, true);
		$this->MultiCell(0, 5, $this->user->web_url, 0, 'R', 0, 0, '', 256, true);

		$this->MultiCell(0, 5, '', 0, 'L', 0, 0, '', 260, true);
		$this->MultiCell(0, 5, $this->user->town_city_country . ' ' . $this->user->postcode, 0, 'R', 0, 0, '', 260, true); 

		//reset true to include header and footer for succeeding pages
		$this->setPrintHeader(true);
		$this->setPrintFooter(true);
		
		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	}

	public function buildReport($params = [])
	{
		$pricing = $this->pricing;
		$client = $pricing->client; // client info
		$accountant = $client->accountant; // accountant info
		$calc = $this->calc;

		// add a page
		$this->AddPage();

		$params = compact('pricing', 'client', 'accountant', 'calc');
		$html = View::make("report.pdf_styles")->render();
		$html .= View::make(
			"report.report", 
			$params
		)->render();

		// output the HTML content
		$this->writeHTML($html, true, false, true, false, '');
	}

	public function buildAppendix()
	{
		$pricing = $this->pricing;
		$client = $pricing->client; // client info
		$accountant = $client->accountant; // accountant info
		
		$this->AddPage();

		$html = View::make("report.pdf_styles")->render();
		$html .= View::make("report.title", array('accountant' => $accountant))->render();

		foreach ($this->pricing->module_pricings as $module_pricing) {
			if ( ! $module_pricing->qty) {
				continue;
			}
			
			$val = (integer) DB::table('accountant_modules')
					->where('accountant_id', $accountant->id)
					->where('module_id', $module_pricing->module_id)
					->pluck('value');
					
			$module = $module_pricing->module;
			$value = $module_pricing->qty * $val;

			$view = "report." . str_replace(' ', '', snake_case($module->name));
			$html .= View::make($view, array('value' => $value))->render();
		}

		$other_service_pricings = $this->pricing->other_service_pricings;
		$html .= View::make("report.other_services", array('accountant' => $accountant, 'other_service_pricings' => $other_service_pricings))->render();

		$this->writeHTML($html, true, false, true, false, '');
	}

	public function buildPlanSummary($params = [])
	{

		$pricing = $this->pricing;
		$client = $pricing->client; // client info
		$accountant = $client->accountant; // accountant info
		$calc = $this->calc;

		$params = $params +  [
			'pricing' => $pricing,
			'client' => $client,
			'accountant' => $accountant,
			'client_id' => $pricing->client_id,
			'pricing_id' => $pricing->id,
			'client_name' => $client->client_name,
			'calc' => $calc
		];

		// add a page
		$this->AddPage();

		$html = View::make("report.pdf_styles")->render();
		$html .= View::make(
			"report.plansummary", 
			$params
		)->render();

		// output the HTML content
		$this->writeHTML($html, true, false, true, false, '');
	}

	public function generate($params = [])
	{
		//$this->buildCoverPage();
		$this->setupPdf($params);
		$this->buildReport($params);

		$this->lastPage();


		$this->Output("Fixed_Price_Fee_Quotation.pdf", 'D');
	}

	public function generateAppendix($params = [])
	{
		//$this->buildCoverPage();
		$this->setupPdf($params);
		$this->buildAppendix($params);

		$this->lastPage();


		$this->Output("Appendices_To_Pricing_Modules.pdf", 'D');
	}

	public function generatePlanSummary($params = [])
	{
		$this->setupPdf($params);
		$this->buildPlanSummary($params);

		$this->lastPage();


		$this->Output("Plan_Summary.pdf", 'D');
	}

}
