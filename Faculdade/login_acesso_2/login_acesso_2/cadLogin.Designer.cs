namespace login_acesso_2
{
    partial class cadLogin
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
            this.btLimpar = new System.Windows.Forms.Button();
            this.btSalvarCad = new System.Windows.Forms.Button();
            this.cbSetorCad = new System.Windows.Forms.ComboBox();
            this.label7 = new System.Windows.Forms.Label();
            this.dtNascCad = new System.Windows.Forms.DateTimePicker();
            this.mtbCPFCad = new System.Windows.Forms.MaskedTextBox();
            this.tbSenhaCad = new System.Windows.Forms.TextBox();
            this.tbLoginCad = new System.Windows.Forms.TextBox();
            this.tbNomeCad = new System.Windows.Forms.TextBox();
            this.label5 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.btSair = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // btLimpar
            // 
            this.btLimpar.Location = new System.Drawing.Point(247, 257);
            this.btLimpar.Name = "btLimpar";
            this.btLimpar.Size = new System.Drawing.Size(75, 23);
            this.btLimpar.TabIndex = 41;
            this.btLimpar.Text = "Limpar";
            this.btLimpar.UseVisualStyleBackColor = true;
            this.btLimpar.Click += new System.EventHandler(this.btExcluir_Click);
            // 
            // btSalvarCad
            // 
            this.btSalvarCad.Location = new System.Drawing.Point(166, 257);
            this.btSalvarCad.Name = "btSalvarCad";
            this.btSalvarCad.Size = new System.Drawing.Size(75, 23);
            this.btSalvarCad.TabIndex = 40;
            this.btSalvarCad.Text = "Salvar";
            this.btSalvarCad.UseVisualStyleBackColor = true;
            this.btSalvarCad.Click += new System.EventHandler(this.btSalvar_Click);
            // 
            // cbSetorCad
            // 
            this.cbSetorCad.FormattingEnabled = true;
            this.cbSetorCad.Items.AddRange(new object[] {
            "Administrador",
            "Convidado",
            "Funcionário"});
            this.cbSetorCad.Location = new System.Drawing.Point(166, 98);
            this.cbSetorCad.Name = "cbSetorCad";
            this.cbSetorCad.Size = new System.Drawing.Size(190, 21);
            this.cbSetorCad.TabIndex = 70;
            // 
            // label7
            // 
            this.label7.AutoSize = true;
            this.label7.Location = new System.Drawing.Point(47, 101);
            this.label7.Name = "label7";
            this.label7.Size = new System.Drawing.Size(35, 13);
            this.label7.TabIndex = 69;
            this.label7.Text = "Setor:";
            // 
            // dtNascCad
            // 
            this.dtNascCad.Format = System.Windows.Forms.DateTimePickerFormat.Short;
            this.dtNascCad.Location = new System.Drawing.Point(166, 72);
            this.dtNascCad.Name = "dtNascCad";
            this.dtNascCad.Size = new System.Drawing.Size(98, 20);
            this.dtNascCad.TabIndex = 68;
            // 
            // mtbCPFCad
            // 
            this.mtbCPFCad.Location = new System.Drawing.Point(166, 46);
            this.mtbCPFCad.Mask = "000,000,000-00";
            this.mtbCPFCad.Name = "mtbCPFCad";
            this.mtbCPFCad.Size = new System.Drawing.Size(190, 20);
            this.mtbCPFCad.TabIndex = 67;
            // 
            // tbSenhaCad
            // 
            this.tbSenhaCad.Location = new System.Drawing.Point(166, 151);
            this.tbSenhaCad.Name = "tbSenhaCad";
            this.tbSenhaCad.PasswordChar = '*';
            this.tbSenhaCad.Size = new System.Drawing.Size(190, 20);
            this.tbSenhaCad.TabIndex = 65;
            // 
            // tbLoginCad
            // 
            this.tbLoginCad.Location = new System.Drawing.Point(166, 125);
            this.tbLoginCad.Name = "tbLoginCad";
            this.tbLoginCad.Size = new System.Drawing.Size(190, 20);
            this.tbLoginCad.TabIndex = 64;
            // 
            // tbNomeCad
            // 
            this.tbNomeCad.Location = new System.Drawing.Point(166, 20);
            this.tbNomeCad.Name = "tbNomeCad";
            this.tbNomeCad.Size = new System.Drawing.Size(190, 20);
            this.tbNomeCad.TabIndex = 63;
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Location = new System.Drawing.Point(47, 154);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(41, 13);
            this.label5.TabIndex = 61;
            this.label5.Text = "Senha:";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(46, 128);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(36, 13);
            this.label4.TabIndex = 60;
            this.label4.Text = "Login:";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(47, 72);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(64, 13);
            this.label3.TabIndex = 59;
            this.label3.Text = "Data Nasc.:";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(47, 49);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(30, 13);
            this.label2.TabIndex = 58;
            this.label2.Text = "CPF:";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(47, 23);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(38, 13);
            this.label1.TabIndex = 57;
            this.label1.Text = "Nome:";
            // 
            // btSair
            // 
            this.btSair.Location = new System.Drawing.Point(328, 257);
            this.btSair.Name = "btSair";
            this.btSair.Size = new System.Drawing.Size(75, 23);
            this.btSair.TabIndex = 71;
            this.btSair.Text = "Sair";
            this.btSair.UseVisualStyleBackColor = true;
            this.btSair.Click += new System.EventHandler(this.btSair_Click);
            // 
            // cadLogin
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(501, 320);
            this.Controls.Add(this.btSair);
            this.Controls.Add(this.cbSetorCad);
            this.Controls.Add(this.label7);
            this.Controls.Add(this.dtNascCad);
            this.Controls.Add(this.mtbCPFCad);
            this.Controls.Add(this.tbSenhaCad);
            this.Controls.Add(this.tbLoginCad);
            this.Controls.Add(this.tbNomeCad);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.btLimpar);
            this.Controls.Add(this.btSalvarCad);
            this.Name = "cadLogin";
            this.Text = "CadFunc";
            this.Load += new System.EventHandler(this.cadLogin_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button btLimpar;
        private System.Windows.Forms.Button btSalvarCad;
        private System.Windows.Forms.ComboBox cbSetorCad;
        private System.Windows.Forms.Label label7;
        private System.Windows.Forms.DateTimePicker dtNascCad;
        private System.Windows.Forms.MaskedTextBox mtbCPFCad;
        private System.Windows.Forms.TextBox tbSenhaCad;
        private System.Windows.Forms.TextBox tbLoginCad;
        private System.Windows.Forms.TextBox tbNomeCad;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Button btSair;
    }
}