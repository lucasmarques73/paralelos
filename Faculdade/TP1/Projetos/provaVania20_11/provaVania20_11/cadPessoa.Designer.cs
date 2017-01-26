namespace provaVania20_11
{
    partial class cadPessoa
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
            this.mtbCPFCad = new System.Windows.Forms.MaskedTextBox();
            this.tbNome = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.tbEnd = new System.Windows.Forms.TextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.tbTel = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.tbRG = new System.Windows.Forms.TextBox();
            this.btSair = new System.Windows.Forms.Button();
            this.btLimpar = new System.Windows.Forms.Button();
            this.btSalvarCad = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // mtbCPFCad
            // 
            this.mtbCPFCad.Location = new System.Drawing.Point(134, 38);
            this.mtbCPFCad.Mask = "000,000,000-00";
            this.mtbCPFCad.Name = "mtbCPFCad";
            this.mtbCPFCad.Size = new System.Drawing.Size(88, 20);
            this.mtbCPFCad.TabIndex = 71;
            // 
            // tbNome
            // 
            this.tbNome.Location = new System.Drawing.Point(134, 12);
            this.tbNome.Name = "tbNome";
            this.tbNome.Size = new System.Drawing.Size(343, 20);
            this.tbNome.TabIndex = 70;
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(15, 41);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(30, 13);
            this.label2.TabIndex = 69;
            this.label2.Text = "CPF:";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(15, 15);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(38, 13);
            this.label1.TabIndex = 68;
            this.label1.Text = "Nome:";
            // 
            // tbEnd
            // 
            this.tbEnd.Location = new System.Drawing.Point(134, 64);
            this.tbEnd.Name = "tbEnd";
            this.tbEnd.Size = new System.Drawing.Size(343, 20);
            this.tbEnd.TabIndex = 73;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(15, 67);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(56, 13);
            this.label3.TabIndex = 72;
            this.label3.Text = "Endereço:";
            // 
            // tbTel
            // 
            this.tbTel.Location = new System.Drawing.Point(134, 90);
            this.tbTel.Name = "tbTel";
            this.tbTel.Size = new System.Drawing.Size(343, 20);
            this.tbTel.TabIndex = 75;
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(15, 93);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(52, 13);
            this.label4.TabIndex = 74;
            this.label4.Text = "Telefone:";
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Location = new System.Drawing.Point(293, 41);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(26, 13);
            this.label5.TabIndex = 76;
            this.label5.Text = "RG:";
            // 
            // tbRG
            // 
            this.tbRG.Location = new System.Drawing.Point(347, 38);
            this.tbRG.Name = "tbRG";
            this.tbRG.Size = new System.Drawing.Size(130, 20);
            this.tbRG.TabIndex = 77;
            // 
            // btSair
            // 
            this.btSair.Location = new System.Drawing.Point(316, 131);
            this.btSair.Name = "btSair";
            this.btSair.Size = new System.Drawing.Size(75, 23);
            this.btSair.TabIndex = 80;
            this.btSair.Text = "Sair";
            this.btSair.UseVisualStyleBackColor = true;
            this.btSair.Click += new System.EventHandler(this.btSair_Click);
            // 
            // btLimpar
            // 
            this.btLimpar.Location = new System.Drawing.Point(235, 131);
            this.btLimpar.Name = "btLimpar";
            this.btLimpar.Size = new System.Drawing.Size(75, 23);
            this.btLimpar.TabIndex = 79;
            this.btLimpar.Text = "Limpar";
            this.btLimpar.UseVisualStyleBackColor = true;
            this.btLimpar.Click += new System.EventHandler(this.btLimpar_Click);
            // 
            // btSalvarCad
            // 
            this.btSalvarCad.Location = new System.Drawing.Point(154, 131);
            this.btSalvarCad.Name = "btSalvarCad";
            this.btSalvarCad.Size = new System.Drawing.Size(75, 23);
            this.btSalvarCad.TabIndex = 78;
            this.btSalvarCad.Text = "Salvar";
            this.btSalvarCad.UseVisualStyleBackColor = true;
            this.btSalvarCad.Click += new System.EventHandler(this.btSalvarCad_Click);
            // 
            // cadPessoa
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(544, 196);
            this.Controls.Add(this.btSair);
            this.Controls.Add(this.btLimpar);
            this.Controls.Add(this.btSalvarCad);
            this.Controls.Add(this.tbRG);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.tbTel);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.tbEnd);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.mtbCPFCad);
            this.Controls.Add(this.tbNome);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Name = "cadPessoa";
            this.Text = "Form1";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.MaskedTextBox mtbCPFCad;
        private System.Windows.Forms.TextBox tbNome;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.TextBox tbEnd;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.TextBox tbTel;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.TextBox tbRG;
        private System.Windows.Forms.Button btSair;
        private System.Windows.Forms.Button btLimpar;
        private System.Windows.Forms.Button btSalvarCad;
    }
}

