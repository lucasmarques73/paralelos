namespace Prl
{
    partial class Form1
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
            this.label1 = new System.Windows.Forms.Label();
            this.tbnome = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.tbemail = new System.Windows.Forms.TextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.label6 = new System.Windows.Forms.Label();
            this.btsalvar = new System.Windows.Forms.Button();
            this.btlimpar = new System.Windows.Forms.Button();
            this.btfechar = new System.Windows.Forms.Button();
            this.textBox7 = new System.Windows.Forms.TextBox();
            this.cbsexo = new System.Windows.Forms.ComboBox();
            this.mtbdtnasc = new System.Windows.Forms.MaskedTextBox();
            this.mtbtel = new System.Windows.Forms.MaskedTextBox();
            this.mtbcel = new System.Windows.Forms.MaskedTextBox();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Georgia", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(26, 13);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(45, 16);
            this.label1.TabIndex = 0;
            this.label1.Text = "Nome";
            // 
            // tbnome
            // 
            this.tbnome.Location = new System.Drawing.Point(93, 13);
            this.tbnome.Name = "tbnome";
            this.tbnome.Size = new System.Drawing.Size(255, 20);
            this.tbnome.TabIndex = 1;
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Georgia", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(409, 13);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(38, 16);
            this.label2.TabIndex = 2;
            this.label2.Text = "Sexo";
            this.label2.Click += new System.EventHandler(this.label2_Click);
            // 
            // tbemail
            // 
            this.tbemail.Location = new System.Drawing.Point(93, 63);
            this.tbemail.Name = "tbemail";
            this.tbemail.Size = new System.Drawing.Size(255, 20);
            this.tbemail.TabIndex = 5;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Georgia", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(26, 63);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(48, 16);
            this.label3.TabIndex = 4;
            this.label3.Text = "E-mail";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Georgia", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.Location = new System.Drawing.Point(409, 63);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(73, 16);
            this.label4.TabIndex = 6;
            this.label4.Text = "Data Nasc.";
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Georgia", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.Location = new System.Drawing.Point(26, 117);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(61, 16);
            this.label5.TabIndex = 8;
            this.label5.Text = "Telefone";
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Font = new System.Drawing.Font("Georgia", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label6.Location = new System.Drawing.Point(409, 113);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(52, 16);
            this.label6.TabIndex = 10;
            this.label6.Text = "Celular";
            // 
            // btsalvar
            // 
            this.btsalvar.Font = new System.Drawing.Font("Lucida Sans Unicode", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btsalvar.Location = new System.Drawing.Point(151, 179);
            this.btsalvar.Name = "btsalvar";
            this.btsalvar.Size = new System.Drawing.Size(75, 23);
            this.btsalvar.TabIndex = 12;
            this.btsalvar.Text = "Salvar";
            this.btsalvar.UseVisualStyleBackColor = true;
            // 
            // btlimpar
            // 
            this.btlimpar.Font = new System.Drawing.Font("Lucida Sans Unicode", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btlimpar.Location = new System.Drawing.Point(303, 179);
            this.btlimpar.Name = "btlimpar";
            this.btlimpar.Size = new System.Drawing.Size(75, 23);
            this.btlimpar.TabIndex = 13;
            this.btlimpar.Text = "Limpar";
            this.btlimpar.UseVisualStyleBackColor = true;
            this.btlimpar.Click += new System.EventHandler(this.btlimpar_Click);
            // 
            // btfechar
            // 
            this.btfechar.FlatStyle = System.Windows.Forms.FlatStyle.System;
            this.btfechar.Font = new System.Drawing.Font("Lucida Sans Unicode", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btfechar.Location = new System.Drawing.Point(438, 179);
            this.btfechar.Name = "btfechar";
            this.btfechar.Size = new System.Drawing.Size(75, 23);
            this.btfechar.TabIndex = 14;
            this.btfechar.Text = "Fechar";
            this.btfechar.UseVisualStyleBackColor = true;
            this.btfechar.Click += new System.EventHandler(this.btfechar_Click);
            // 
            // textBox7
            // 
            this.textBox7.Location = new System.Drawing.Point(38, 218);
            this.textBox7.Multiline = true;
            this.textBox7.Name = "textBox7";
            this.textBox7.Size = new System.Drawing.Size(581, 145);
            this.textBox7.TabIndex = 15;
            // 
            // cbsexo
            // 
            this.cbsexo.FormattingEnabled = true;
            this.cbsexo.Items.AddRange(new object[] {
            "Fem",
            "Masc"});
            this.cbsexo.Location = new System.Drawing.Point(488, 13);
            this.cbsexo.Name = "cbsexo";
            this.cbsexo.Size = new System.Drawing.Size(52, 21);
            this.cbsexo.TabIndex = 16;
            // 
            // mtbdtnasc
            // 
            this.mtbdtnasc.Location = new System.Drawing.Point(488, 63);
            this.mtbdtnasc.Mask = "00/00/00";
            this.mtbdtnasc.Name = "mtbdtnasc";
            this.mtbdtnasc.Size = new System.Drawing.Size(65, 20);
            this.mtbdtnasc.TabIndex = 17;
            // 
            // mtbtel
            // 
            this.mtbtel.Location = new System.Drawing.Point(93, 116);
            this.mtbtel.Mask = "(99) 90000-0000";
            this.mtbtel.Name = "mtbtel";
            this.mtbtel.Size = new System.Drawing.Size(94, 20);
            this.mtbtel.TabIndex = 18;
            // 
            // mtbcel
            // 
            this.mtbcel.Location = new System.Drawing.Point(488, 112);
            this.mtbcel.Mask = "(99) 90000-0000";
            this.mtbcel.Name = "mtbcel";
            this.mtbcel.Size = new System.Drawing.Size(94, 20);
            this.mtbcel.TabIndex = 19;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.SystemColors.ActiveCaption;
            this.ClientSize = new System.Drawing.Size(658, 396);
            this.Controls.Add(this.mtbcel);
            this.Controls.Add(this.mtbtel);
            this.Controls.Add(this.mtbdtnasc);
            this.Controls.Add(this.cbsexo);
            this.Controls.Add(this.textBox7);
            this.Controls.Add(this.btfechar);
            this.Controls.Add(this.btlimpar);
            this.Controls.Add(this.btsalvar);
            this.Controls.Add(this.label6);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.tbemail);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.tbnome);
            this.Controls.Add(this.label1);
            this.Name = "Form1";
            this.Text = "Agenda Tabajara X";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.TextBox tbnome;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox tbemail;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.Button btsalvar;
        private System.Windows.Forms.Button btlimpar;
        private System.Windows.Forms.Button btfechar;
        private System.Windows.Forms.TextBox textBox7;
        private System.Windows.Forms.ComboBox cbsexo;
        private System.Windows.Forms.MaskedTextBox mtbdtnasc;
        private System.Windows.Forms.MaskedTextBox mtbtel;
        private System.Windows.Forms.MaskedTextBox mtbcel;
    }
}

