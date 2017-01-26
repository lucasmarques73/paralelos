namespace ProjetoIntegrador
{
    partial class buscaPessoa
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
            this.tbNomePessoa = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.btBuscar = new System.Windows.Forms.Button();
            this.btLimparPessoa = new System.Windows.Forms.Button();
            this.btSairPessoa = new System.Windows.Forms.Button();
            this.btAbrirPessoa = new System.Windows.Forms.Button();
            this.dtExibePessoa = new System.Windows.Forms.DataGridView();
            this.Codigo = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Nome = new System.Windows.Forms.DataGridViewTextBoxColumn();
            ((System.ComponentModel.ISupportInitialize)(this.dtExibePessoa)).BeginInit();
            this.SuspendLayout();
            // 
            // tbNomePessoa
            // 
            this.tbNomePessoa.Location = new System.Drawing.Point(81, 12);
            this.tbNomePessoa.Name = "tbNomePessoa";
            this.tbNomePessoa.Size = new System.Drawing.Size(349, 20);
            this.tbNomePessoa.TabIndex = 61;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(12, 12);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(44, 18);
            this.label1.TabIndex = 60;
            this.label1.Text = "Nome:";
            // 
            // btBuscar
            // 
            this.btBuscar.Location = new System.Drawing.Point(436, 12);
            this.btBuscar.Name = "btBuscar";
            this.btBuscar.Size = new System.Drawing.Size(75, 23);
            this.btBuscar.TabIndex = 62;
            this.btBuscar.Text = "Buscar";
            this.btBuscar.UseVisualStyleBackColor = true;
            this.btBuscar.Click += new System.EventHandler(this.btBuscar_Click);
            // 
            // btLimparPessoa
            // 
            this.btLimparPessoa.Location = new System.Drawing.Point(361, 176);
            this.btLimparPessoa.Name = "btLimparPessoa";
            this.btLimparPessoa.Size = new System.Drawing.Size(75, 23);
            this.btLimparPessoa.TabIndex = 65;
            this.btLimparPessoa.Text = "Limpar";
            this.btLimparPessoa.UseVisualStyleBackColor = true;
            // 
            // btSairPessoa
            // 
            this.btSairPessoa.Location = new System.Drawing.Point(442, 176);
            this.btSairPessoa.Name = "btSairPessoa";
            this.btSairPessoa.Size = new System.Drawing.Size(75, 23);
            this.btSairPessoa.TabIndex = 64;
            this.btSairPessoa.Text = "Sair";
            this.btSairPessoa.UseVisualStyleBackColor = true;
            this.btSairPessoa.Click += new System.EventHandler(this.btSairPessoa_Click);
            // 
            // btAbrirPessoa
            // 
            this.btAbrirPessoa.Location = new System.Drawing.Point(280, 176);
            this.btAbrirPessoa.Name = "btAbrirPessoa";
            this.btAbrirPessoa.Size = new System.Drawing.Size(75, 23);
            this.btAbrirPessoa.TabIndex = 63;
            this.btAbrirPessoa.Text = "Abrir";
            this.btAbrirPessoa.UseVisualStyleBackColor = true;
            // 
            // dtExibePessoa
            // 
            this.dtExibePessoa.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dtExibePessoa.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.Codigo,
            this.Nome});
            this.dtExibePessoa.Location = new System.Drawing.Point(81, 38);
            this.dtExibePessoa.Name = "dtExibePessoa";
            this.dtExibePessoa.Size = new System.Drawing.Size(349, 121);
            this.dtExibePessoa.TabIndex = 66;
            // 
            // Codigo
            // 
            this.Codigo.HeaderText = "Código";
            this.Codigo.Name = "Codigo";
            this.Codigo.Width = 50;
            // 
            // Nome
            // 
            this.Nome.HeaderText = "Nome";
            this.Nome.Name = "Nome";
            this.Nome.Width = 250;
            // 
            // buscaPessoa
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(523, 211);
            this.Controls.Add(this.dtExibePessoa);
            this.Controls.Add(this.btLimparPessoa);
            this.Controls.Add(this.btSairPessoa);
            this.Controls.Add(this.btAbrirPessoa);
            this.Controls.Add(this.btBuscar);
            this.Controls.Add(this.tbNomePessoa);
            this.Controls.Add(this.label1);
            this.Name = "buscaPessoa";
            this.Text = "buscaPessoa";
            ((System.ComponentModel.ISupportInitialize)(this.dtExibePessoa)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.TextBox tbNomePessoa;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Button btBuscar;
        private System.Windows.Forms.Button btLimparPessoa;
        private System.Windows.Forms.Button btSairPessoa;
        private System.Windows.Forms.Button btAbrirPessoa;
        private System.Windows.Forms.DataGridView dtExibePessoa;
        private System.Windows.Forms.DataGridViewTextBoxColumn Codigo;
        private System.Windows.Forms.DataGridViewTextBoxColumn Nome;
    }
}