namespace ProjetoIntegrador
{
    partial class buscaPRod
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            this.label5 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.cbProdBusc = new System.Windows.Forms.ComboBox();
            this.tbQtBusc = new System.Windows.Forms.TextBox();
            this.cbUnidadeBusca = new System.Windows.Forms.ComboBox();
            this.btLimparOS = new System.Windows.Forms.Button();
            this.btSairOS = new System.Windows.Forms.Button();
            this.btAddProd = new System.Windows.Forms.Button();
            this.bdLojaInfoDataSet = new ProjetoIntegrador.bdLojaInfoDataSet();
            this.tblProdutoBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.tblProdutoTableAdapter = new ProjetoIntegrador.bdLojaInfoDataSetTableAdapters.tblProdutoTableAdapter();
            this.tblUnidadeBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.tblUnidadeTableAdapter = new ProjetoIntegrador.bdLojaInfoDataSetTableAdapters.tblUnidadeTableAdapter();
            ((System.ComponentModel.ISupportInitialize)(this.bdLojaInfoDataSet)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblProdutoBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblUnidadeBindingSource)).BeginInit();
            this.SuspendLayout();
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.Location = new System.Drawing.Point(14, 18);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(57, 18);
            this.label5.TabIndex = 7;
            this.label5.Text = "Produto:";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(12, 58);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(77, 18);
            this.label1.TabIndex = 8;
            this.label1.Text = "Quantidade:";
            // 
            // cbProdBusc
            // 
            this.cbProdBusc.DataSource = this.tblProdutoBindingSource;
            this.cbProdBusc.DisplayMember = "nomeProduto";
            this.cbProdBusc.FormattingEnabled = true;
            this.cbProdBusc.Location = new System.Drawing.Point(92, 18);
            this.cbProdBusc.Name = "cbProdBusc";
            this.cbProdBusc.Size = new System.Drawing.Size(296, 21);
            this.cbProdBusc.TabIndex = 9;
            this.cbProdBusc.ValueMember = "codProduto";
            // 
            // tbQtBusc
            // 
            this.tbQtBusc.Location = new System.Drawing.Point(92, 55);
            this.tbQtBusc.Name = "tbQtBusc";
            this.tbQtBusc.Size = new System.Drawing.Size(100, 20);
            this.tbQtBusc.TabIndex = 10;
            // 
            // cbUnidadeBusca
            // 
            this.cbUnidadeBusca.DataSource = this.tblUnidadeBindingSource;
            this.cbUnidadeBusca.DisplayMember = "nomeUnidade";
            this.cbUnidadeBusca.FormattingEnabled = true;
            this.cbUnidadeBusca.Location = new System.Drawing.Point(198, 54);
            this.cbUnidadeBusca.Name = "cbUnidadeBusca";
            this.cbUnidadeBusca.Size = new System.Drawing.Size(78, 21);
            this.cbUnidadeBusca.TabIndex = 25;
            this.cbUnidadeBusca.ValueMember = "codUnidade";
            // 
            // btLimparOS
            // 
            this.btLimparOS.Location = new System.Drawing.Point(229, 117);
            this.btLimparOS.Name = "btLimparOS";
            this.btLimparOS.Size = new System.Drawing.Size(75, 23);
            this.btLimparOS.TabIndex = 28;
            this.btLimparOS.Text = "Limpar";
            this.btLimparOS.UseVisualStyleBackColor = true;
            this.btLimparOS.Click += new System.EventHandler(this.btLimparOS_Click);
            // 
            // btSairOS
            // 
            this.btSairOS.Location = new System.Drawing.Point(310, 117);
            this.btSairOS.Name = "btSairOS";
            this.btSairOS.Size = new System.Drawing.Size(75, 23);
            this.btSairOS.TabIndex = 27;
            this.btSairOS.Text = "Sair";
            this.btSairOS.UseVisualStyleBackColor = true;
            this.btSairOS.Click += new System.EventHandler(this.btSairOS_Click);
            // 
            // btAddProd
            // 
            this.btAddProd.Location = new System.Drawing.Point(148, 117);
            this.btAddProd.Name = "btAddProd";
            this.btAddProd.Size = new System.Drawing.Size(75, 23);
            this.btAddProd.TabIndex = 26;
            this.btAddProd.Text = "Adicionar";
            this.btAddProd.UseVisualStyleBackColor = true;
            // 
            // bdLojaInfoDataSet
            // 
            this.bdLojaInfoDataSet.DataSetName = "bdLojaInfoDataSet";
            this.bdLojaInfoDataSet.SchemaSerializationMode = System.Data.SchemaSerializationMode.IncludeSchema;
            // 
            // tblProdutoBindingSource
            // 
            this.tblProdutoBindingSource.DataMember = "tblProduto";
            this.tblProdutoBindingSource.DataSource = this.bdLojaInfoDataSet;
            // 
            // tblProdutoTableAdapter
            // 
            this.tblProdutoTableAdapter.ClearBeforeFill = true;
            // 
            // tblUnidadeBindingSource
            // 
            this.tblUnidadeBindingSource.DataMember = "tblUnidade";
            this.tblUnidadeBindingSource.DataSource = this.bdLojaInfoDataSet;
            // 
            // tblUnidadeTableAdapter
            // 
            this.tblUnidadeTableAdapter.ClearBeforeFill = true;
            // 
            // buscaPRod
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(400, 161);
            this.Controls.Add(this.btLimparOS);
            this.Controls.Add(this.btSairOS);
            this.Controls.Add(this.btAddProd);
            this.Controls.Add(this.cbUnidadeBusca);
            this.Controls.Add(this.tbQtBusc);
            this.Controls.Add(this.cbProdBusc);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.label5);
            this.Name = "buscaPRod";
            this.Text = "buscaPRod";
            this.Load += new System.EventHandler(this.buscaPRod_Load);
            ((System.ComponentModel.ISupportInitialize)(this.bdLojaInfoDataSet)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblProdutoBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblUnidadeBindingSource)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.ComboBox cbProdBusc;
        private System.Windows.Forms.TextBox tbQtBusc;
        private System.Windows.Forms.ComboBox cbUnidadeBusca;
        private System.Windows.Forms.Button btLimparOS;
        private System.Windows.Forms.Button btSairOS;
        private System.Windows.Forms.Button btAddProd;
        private bdLojaInfoDataSet bdLojaInfoDataSet;
        private System.Windows.Forms.BindingSource tblProdutoBindingSource;
        private bdLojaInfoDataSetTableAdapters.tblProdutoTableAdapter tblProdutoTableAdapter;
        private System.Windows.Forms.BindingSource tblUnidadeBindingSource;
        private bdLojaInfoDataSetTableAdapters.tblUnidadeTableAdapter tblUnidadeTableAdapter;
    }
}