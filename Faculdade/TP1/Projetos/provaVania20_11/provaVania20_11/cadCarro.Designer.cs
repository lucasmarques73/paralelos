namespace provaVania20_11
{
    partial class cadCarro
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
            this.tbPlaca = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.tbRenavan = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.tbAno = new System.Windows.Forms.TextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.tbModelo = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.tbFabr = new System.Windows.Forms.TextBox();
            this.label5 = new System.Windows.Forms.Label();
            this.btSair = new System.Windows.Forms.Button();
            this.btLimpar = new System.Windows.Forms.Button();
            this.btSalvarCad = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // tbPlaca
            // 
            this.tbPlaca.Location = new System.Drawing.Point(123, 12);
            this.tbPlaca.Name = "tbPlaca";
            this.tbPlaca.Size = new System.Drawing.Size(96, 20);
            this.tbPlaca.TabIndex = 72;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(4, 15);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(37, 13);
            this.label1.TabIndex = 71;
            this.label1.Text = "Placa:";
            // 
            // tbRenavan
            // 
            this.tbRenavan.Location = new System.Drawing.Point(123, 38);
            this.tbRenavan.Name = "tbRenavan";
            this.tbRenavan.Size = new System.Drawing.Size(343, 20);
            this.tbRenavan.TabIndex = 74;
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(4, 41);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(62, 13);
            this.label2.TabIndex = 73;
            this.label2.Text = "RENAVAN:";
            // 
            // tbAno
            // 
            this.tbAno.Location = new System.Drawing.Point(370, 12);
            this.tbAno.Name = "tbAno";
            this.tbAno.Size = new System.Drawing.Size(96, 20);
            this.tbAno.TabIndex = 76;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(251, 15);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(29, 13);
            this.label3.TabIndex = 75;
            this.label3.Text = "Ano:";
            // 
            // tbModelo
            // 
            this.tbModelo.Location = new System.Drawing.Point(123, 64);
            this.tbModelo.Name = "tbModelo";
            this.tbModelo.Size = new System.Drawing.Size(343, 20);
            this.tbModelo.TabIndex = 78;
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(4, 67);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(45, 13);
            this.label4.TabIndex = 77;
            this.label4.Text = "Modelo:";
            // 
            // tbFabr
            // 
            this.tbFabr.Location = new System.Drawing.Point(123, 90);
            this.tbFabr.Name = "tbFabr";
            this.tbFabr.Size = new System.Drawing.Size(343, 20);
            this.tbFabr.TabIndex = 80;
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Location = new System.Drawing.Point(4, 93);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(60, 13);
            this.label5.TabIndex = 79;
            this.label5.Text = "Fabricante:";
            // 
            // btSair
            // 
            this.btSair.Location = new System.Drawing.Point(325, 138);
            this.btSair.Name = "btSair";
            this.btSair.Size = new System.Drawing.Size(75, 23);
            this.btSair.TabIndex = 83;
            this.btSair.Text = "Sair";
            this.btSair.UseVisualStyleBackColor = true;
            this.btSair.Click += new System.EventHandler(this.btSair_Click);
            // 
            // btLimpar
            // 
            this.btLimpar.Location = new System.Drawing.Point(244, 138);
            this.btLimpar.Name = "btLimpar";
            this.btLimpar.Size = new System.Drawing.Size(75, 23);
            this.btLimpar.TabIndex = 82;
            this.btLimpar.Text = "Limpar";
            this.btLimpar.UseVisualStyleBackColor = true;
            this.btLimpar.Click += new System.EventHandler(this.btLimpar_Click);
            // 
            // btSalvarCad
            // 
            this.btSalvarCad.Location = new System.Drawing.Point(163, 138);
            this.btSalvarCad.Name = "btSalvarCad";
            this.btSalvarCad.Size = new System.Drawing.Size(75, 23);
            this.btSalvarCad.TabIndex = 81;
            this.btSalvarCad.Text = "Salvar";
            this.btSalvarCad.UseVisualStyleBackColor = true;
            this.btSalvarCad.Click += new System.EventHandler(this.btSalvarCad_Click);
            // 
            // cadCarro
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(504, 218);
            this.Controls.Add(this.btSair);
            this.Controls.Add(this.btLimpar);
            this.Controls.Add(this.btSalvarCad);
            this.Controls.Add(this.tbFabr);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.tbModelo);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.tbAno);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.tbRenavan);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.tbPlaca);
            this.Controls.Add(this.label1);
            this.Name = "cadCarro";
            this.Text = "cadCarro";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.TextBox tbPlaca;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.TextBox tbRenavan;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox tbAno;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.TextBox tbModelo;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.TextBox tbFabr;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Button btSair;
        private System.Windows.Forms.Button btLimpar;
        private System.Windows.Forms.Button btSalvarCad;
    }
}