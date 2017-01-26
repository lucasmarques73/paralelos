/*
 * Created by SharpDevelop.
 * User: macoratti
 * Date: 7/23/2008
 * Time: 13:56
 * 
 */
using System;
using System.Drawing;
using System.Windows.Forms;
using System.Data;
using MySql.Data.MySqlClient;

namespace MySqlSample

{
	/// <summary>
	/// conexao com mysql
	/// </summary>
	public class MainForm : System.Windows.Forms.Form
	{
		
    	private MySqlConnection mConn;
    	private MySqlDataAdapter mAdapter;
    	private DataSet mDataSet;
		
		public MainForm()
		{
			InitializeComponent();
		
			//define o dataset
    		mDataSet = new DataSet();
    		//defina string de conexao e cria a conexao
			mConn = new MySqlConnection("Persist Security Info=False;server=localhost;database=Cadastro;uid=root;pwd=gpxpst");
			
			try{
				//abre a conexao
				mConn.Open();
			}
			catch(System.Exception e)
			{
				MessageBox.Show(e.Message.ToString());
			}
			//verificva se a conexão esta aberta
			if (mConn.State == ConnectionState.Open)
			{
				//cria um adapter usando a instrução SQL para acessar a tabela Clientes
    			mAdapter = new MySqlDataAdapter("SELECT * FROM Clientes", mConn);
    			//preenche o dataset via adapter
    			mAdapter.Fill(mDataSet, "Clientes");
    			//atribui a resultado a propriedade DataSource do DataGrid
    			mDataGrid.DataSource = mDataSet;
    			mDataGrid.DataMember = "Clientes";
    			
			}
		}
		
		protected override void Dispose(bool disposing)
		{
			if (disposing)
			{
				if (mConn.State == ConnectionState.Open)
				{
					mConn.Close();
				}
			}
			base.Dispose(disposing);
		}
		
		[STAThread]
		public static void Main(string[] args)
		{
			Application.Run(new MainForm());
		}
		
		#region Windows Forms Designer generated code
		/// <summary>
		/// This method is required for Windows Forms designer support.
		/// Do not change the method contents inside the source code editor. The Forms designer might
		/// not be able to load this method if it was changed manually.
		/// </summary>
		private void InitializeComponent() {
			this.mDataGrid = new System.Windows.Forms.DataGrid();
			((System.ComponentModel.ISupportInitialize)(this.mDataGrid)).BeginInit();
			this.SuspendLayout();
			// 
			// mDataGrid
			// 
			this.mDataGrid.AlternatingBackColor = System.Drawing.Color.White;
			this.mDataGrid.BackColor = System.Drawing.Color.White;
			this.mDataGrid.BackgroundColor = System.Drawing.Color.Gainsboro;
			this.mDataGrid.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
			this.mDataGrid.CaptionBackColor = System.Drawing.Color.Silver;
			this.mDataGrid.CaptionFont = new System.Drawing.Font("Microsoft Sans Serif", 8.25F);
			this.mDataGrid.CaptionForeColor = System.Drawing.Color.Black;
			this.mDataGrid.CaptionText = "Tabela Clientes";
			this.mDataGrid.DataMember = "";
			this.mDataGrid.Dock = System.Windows.Forms.DockStyle.Fill;
			this.mDataGrid.FlatMode = true;
			this.mDataGrid.Font = new System.Drawing.Font("Microsoft Sans Serif", 8.25F);
			this.mDataGrid.ForeColor = System.Drawing.Color.DarkSlateGray;
			this.mDataGrid.GridLineColor = System.Drawing.Color.DarkGray;
			this.mDataGrid.HeaderBackColor = System.Drawing.Color.DarkGreen;
			this.mDataGrid.HeaderFont = new System.Drawing.Font("Microsoft Sans Serif", 8.25F);
			this.mDataGrid.HeaderForeColor = System.Drawing.Color.White;
			this.mDataGrid.LinkColor = System.Drawing.Color.DarkGreen;
			this.mDataGrid.Location = new System.Drawing.Point(0, 0);
			this.mDataGrid.Name = "mDataGrid";
			this.mDataGrid.ParentRowsBackColor = System.Drawing.Color.Gainsboro;
			this.mDataGrid.ParentRowsForeColor = System.Drawing.Color.Black;
			this.mDataGrid.PreferredColumnWidth = 100;
			this.mDataGrid.SelectionBackColor = System.Drawing.Color.DarkSeaGreen;
			this.mDataGrid.SelectionForeColor = System.Drawing.Color.Black;
			this.mDataGrid.Size = new System.Drawing.Size(480, 286);
			this.mDataGrid.TabIndex = 0;
						// 
			// MainForm
			// 
			this.AutoScaleBaseSize = new System.Drawing.Size(5, 13);
			this.ClientSize = new System.Drawing.Size(480, 286);
			this.Controls.Add(this.mDataGrid);
			this.Name = "MainForm";
			this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
			this.Text = "Acessando MySQL";
			((System.ComponentModel.ISupportInitialize)(this.mDataGrid)).EndInit();
			this.ResumeLayout(false);
		}
		private System.Windows.Forms.DataGrid mDataGrid;
		#endregion
		
		
	}
}
