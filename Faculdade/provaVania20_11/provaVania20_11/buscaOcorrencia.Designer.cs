namespace provaVania20_11
{
    partial class buscaOcorrencia
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
            this.tbBuscaPlaca = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.dtExibe = new System.Windows.Forms.DataGridView();
            this.btSair = new System.Windows.Forms.Button();
            this.btBuscar = new System.Windows.Forms.Button();
            this.Numero = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Data = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Local = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Descricao = new System.Windows.Forms.DataGridViewTextBoxColumn();
            ((System.ComponentModel.ISupportInitialize)(this.dtExibe)).BeginInit();
            this.SuspendLayout();
            // 
            // tbBuscaPlaca
            // 
            this.tbBuscaPlaca.Location = new System.Drawing.Point(55, 11);
            this.tbBuscaPlaca.Name = "tbBuscaPlaca";
            this.tbBuscaPlaca.Size = new System.Drawing.Size(458, 20);
            this.tbBuscaPlaca.TabIndex = 80;
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(12, 14);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(37, 13);
            this.label4.TabIndex = 79;
            this.label4.Text = "Placa:";
            // 
            // dtExibe
            // 
            this.dtExibe.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dtExibe.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.Numero,
            this.Data,
            this.Local,
            this.Descricao});
            this.dtExibe.Location = new System.Drawing.Point(55, 43);
            this.dtExibe.Name = "dtExibe";
            this.dtExibe.Size = new System.Drawing.Size(539, 150);
            this.dtExibe.TabIndex = 81;
            // 
            // btSair
            // 
            this.btSair.Location = new System.Drawing.Point(519, 234);
            this.btSair.Name = "btSair";
            this.btSair.Size = new System.Drawing.Size(75, 23);
            this.btSair.TabIndex = 84;
            this.btSair.Text = "Sair";
            this.btSair.UseVisualStyleBackColor = true;
            this.btSair.Click += new System.EventHandler(this.btSair_Click);
            // 
            // btBuscar
            // 
            this.btBuscar.Location = new System.Drawing.Point(519, 11);
            this.btBuscar.Name = "btBuscar";
            this.btBuscar.Size = new System.Drawing.Size(75, 23);
            this.btBuscar.TabIndex = 85;
            this.btBuscar.Text = "Buscar";
            this.btBuscar.UseVisualStyleBackColor = true;
            this.btBuscar.Click += new System.EventHandler(this.btBuscar_Click);
            // 
            // Numero
            // 
            this.Numero.HeaderText = "Número";
            this.Numero.Name = "Numero";
            this.Numero.Width = 90;
            // 
            // Data
            // 
            this.Data.HeaderText = "Data";
            this.Data.Name = "Data";
            this.Data.Width = 70;
            // 
            // Local
            // 
            this.Local.HeaderText = "Local";
            this.Local.Name = "Local";
            // 
            // Descricao
            // 
            this.Descricao.HeaderText = "Descrição";
            this.Descricao.Name = "Descricao";
            this.Descricao.Width = 220;
            // 
            // buscaOcorrencia
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(606, 269);
            this.Controls.Add(this.btBuscar);
            this.Controls.Add(this.btSair);
            this.Controls.Add(this.dtExibe);
            this.Controls.Add(this.tbBuscaPlaca);
            this.Controls.Add(this.label4);
            this.Name = "buscaOcorrencia";
            this.Text = "buscaOcorrencia";
            ((System.ComponentModel.ISupportInitialize)(this.dtExibe)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.TextBox tbBuscaPlaca;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.DataGridView dtExibe;
        private System.Windows.Forms.Button btSair;
        private System.Windows.Forms.Button btBuscar;
        private System.Windows.Forms.DataGridViewTextBoxColumn Numero;
        private System.Windows.Forms.DataGridViewTextBoxColumn Data;
        private System.Windows.Forms.DataGridViewTextBoxColumn Local;
        private System.Windows.Forms.DataGridViewTextBoxColumn Descricao;
    }
}