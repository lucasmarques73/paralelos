namespace ProjetoIntegrador
{
    partial class cadTelefone
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
            this.label5 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.btLimparOS = new System.Windows.Forms.Button();
            this.btSairOS = new System.Windows.Forms.Button();
            this.btSalvarOS = new System.Windows.Forms.Button();
            this.cbTipoTel = new System.Windows.Forms.ComboBox();
            this.mtbDDD = new System.Windows.Forms.MaskedTextBox();
            this.mtbNumero = new System.Windows.Forms.MaskedTextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.tbNomeTel = new System.Windows.Forms.TextBox();
            this.SuspendLayout();
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.Location = new System.Drawing.Point(39, 53);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(37, 18);
            this.label5.TabIndex = 5;
            this.label5.Text = "Tipo:";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(39, 83);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(36, 18);
            this.label1.TabIndex = 6;
            this.label1.Text = "DDD:";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(131, 81);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(56, 18);
            this.label2.TabIndex = 7;
            this.label2.Text = "Número:";
            // 
            // btLimparOS
            // 
            this.btLimparOS.Location = new System.Drawing.Point(201, 151);
            this.btLimparOS.Name = "btLimparOS";
            this.btLimparOS.Size = new System.Drawing.Size(75, 23);
            this.btLimparOS.TabIndex = 21;
            this.btLimparOS.Text = "Limpar";
            this.btLimparOS.UseVisualStyleBackColor = true;
            this.btLimparOS.Click += new System.EventHandler(this.btLimparOS_Click);
            // 
            // btSairOS
            // 
            this.btSairOS.Location = new System.Drawing.Point(282, 151);
            this.btSairOS.Name = "btSairOS";
            this.btSairOS.Size = new System.Drawing.Size(75, 23);
            this.btSairOS.TabIndex = 20;
            this.btSairOS.Text = "Sair";
            this.btSairOS.UseVisualStyleBackColor = true;
            this.btSairOS.Click += new System.EventHandler(this.btSairOS_Click);
            // 
            // btSalvarOS
            // 
            this.btSalvarOS.Location = new System.Drawing.Point(120, 151);
            this.btSalvarOS.Name = "btSalvarOS";
            this.btSalvarOS.Size = new System.Drawing.Size(75, 23);
            this.btSalvarOS.TabIndex = 19;
            this.btSalvarOS.Text = "Salvar";
            this.btSalvarOS.UseVisualStyleBackColor = true;
            this.btSalvarOS.Click += new System.EventHandler(this.btSalvarOS_Click);
            // 
            // cbTipoTel
            // 
            this.cbTipoTel.FormattingEnabled = true;
            this.cbTipoTel.Items.AddRange(new object[] {
            "Celular",
            "Residencial",
            "Comercial"});
            this.cbTipoTel.Location = new System.Drawing.Point(92, 50);
            this.cbTipoTel.Name = "cbTipoTel";
            this.cbTipoTel.Size = new System.Drawing.Size(158, 21);
            this.cbTipoTel.TabIndex = 22;
            // 
            // mtbDDD
            // 
            this.mtbDDD.Location = new System.Drawing.Point(92, 80);
            this.mtbDDD.Mask = "(000)";
            this.mtbDDD.Name = "mtbDDD";
            this.mtbDDD.Size = new System.Drawing.Size(33, 20);
            this.mtbDDD.TabIndex = 23;
            // 
            // mtbNumero
            // 
            this.mtbNumero.Location = new System.Drawing.Point(193, 79);
            this.mtbNumero.Mask = "0000-0000";
            this.mtbNumero.Name = "mtbNumero";
            this.mtbNumero.Size = new System.Drawing.Size(57, 20);
            this.mtbNumero.TabIndex = 24;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(32, 9);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(44, 18);
            this.label3.TabIndex = 25;
            this.label3.Text = "Nome:";
            // 
            // tbNomeTel
            // 
            this.tbNomeTel.Location = new System.Drawing.Point(92, 6);
            this.tbNomeTel.Name = "tbNomeTel";
            this.tbNomeTel.Size = new System.Drawing.Size(264, 20);
            this.tbNomeTel.TabIndex = 26;
            // 
            // cadTelefone
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(368, 186);
            this.Controls.Add(this.tbNomeTel);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.mtbNumero);
            this.Controls.Add(this.mtbDDD);
            this.Controls.Add(this.cbTipoTel);
            this.Controls.Add(this.btLimparOS);
            this.Controls.Add(this.btSairOS);
            this.Controls.Add(this.btSalvarOS);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.label5);
            this.Name = "cadTelefone";
            this.Text = "cadTelefone";
            this.Load += new System.EventHandler(this.cadTelefone_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Button btLimparOS;
        private System.Windows.Forms.Button btSairOS;
        private System.Windows.Forms.Button btSalvarOS;
        private System.Windows.Forms.ComboBox cbTipoTel;
        private System.Windows.Forms.MaskedTextBox mtbDDD;
        private System.Windows.Forms.MaskedTextBox mtbNumero;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.TextBox tbNomeTel;
    }
}